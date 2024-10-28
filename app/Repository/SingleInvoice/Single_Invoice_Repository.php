<?php

namespace App\Repository\SingleInvoice;

use App\Interfaces\SingleInvoice\Single_Invoice_Interface;
use App\Mail\SendInvoiceMail;
use App\Models\Boxes\Fund_Schedule;
use App\Models\Boxes\PatientAccount;
use App\Models\Doctors\Doctor;
use App\Models\Invoices\SingleInvoice;
use App\Models\Patients\Patient;
use App\Models\Sections\Section;
use App\Models\Service\SingleService;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class Single_Invoice_Repository implements Single_Invoice_Interface {

    public function index(){

        $singleInvoices=SingleInvoice::all();
       $patients=Patient::all();
       $doctors=Doctor::all();
       $sections =Section::all();
       $services =SingleService::all();
        return view('Dashboard.Invoices.index',compact('singleInvoices','patients','doctors','sections','services'));
    }

    public function store($request)
    {
        try{
            DB::beginTransaction();
            $singleInvoice=new SingleInvoice();
            $singleInvoice->invoice_date=now();
            $singleInvoice->patient_id=$request->patient_id;
            $singleInvoice->doctor_id=$request->doctor_id;
            $singleInvoice->section_id=$request->section_id;
            $singleInvoice->service_id=$request->service_id;
            $singleInvoice->price=$request->price;
            $singleInvoice->discount_value=$request->discount_value;
            $singleInvoice->tax_rate=$request->tax_rate;
            $singleInvoice->tax_value=$request->tax_value;
            $tot_before_tax=$request->price - $request->discount_value;//3500
            $tot_after_tax=($tot_before_tax*($request->tax_rate))/100;//1500
            $final=$tot_after_tax+$tot_before_tax;
            $singleInvoice->tot_with_tax=$final;
            $singleInvoice->type=$request->type;
            $singleInvoice->save();
            if($singleInvoice->type==1){
                //حفظ في جدول الفواتير
              //حفظ في جدول الصندوق
                $fundschedules=new Fund_Schedule();
                $fundschedules->date=now();
                $fundschedules->single_invoice_id=$singleInvoice->id;
                $fundschedules->credit=0.00;
                $fundschedules->debit= $singleInvoice->tot_with_tax;
                $fundschedules->save();
                //ارسال رسالة تتصمن للسمتخم تعريفه بانه دفع


            }else{
               //حفظ في جدول الفواتير
                //حفظ في جدول حسابات المريض
                $patient_account= new PatientAccount();
                $patient_account->date=now();
                $patient_account->single_invoice_id=$singleInvoice->id;
                $patient_account->patient_id=$singleInvoice->patient->id;
                $patient_account->debit=$singleInvoice->tot_with_tax;
                $patient_account->credit=0.00;
                $patient_account->save();
                //اظهار رساله للمستخدم بانه لم يدفع

            }
            DB::commit();
            Mail::to($singleInvoice->patient->email)->send(new SendInvoiceMail($singleInvoice));
             session()->flash('add');
             return back();


        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }

    }

    public function edit($id)
    {
        $singleInvoice=SingleInvoice::findOrFail($id);
        $patients=Patient::all();
        $doctors=Doctor::all();
        $sections =Section::all();
        $services =SingleService::all();
        return view('Dashboard.Invoices.update',compact('singleInvoice','patients','doctors','sections','services'));
    }

    public function update($id,  $request)
    {
        try {
            // بدء المعاملة
            DB::beginTransaction();

            // إيجاد الفاتورة باستخدام المعرف أو إرجاع خطأ
            $singleInvoice = SingleInvoice::findOrFail($id);

            // تحديث بيانات الفاتورة
            $singleInvoice->patient_id = $request->patient_id;
            $singleInvoice->doctor_id = $request->doctor_id;
            $singleInvoice->section_id = $request->section_id;
            $singleInvoice->service_id = $request->service_id;
            $singleInvoice->price = $request->price;
            $singleInvoice->discount_value = $request->discount_value;
            $singleInvoice->tax_rate = $request->tax_rate;

            // حساب الضريبة والقيمة النهائية
            $tot_before_tax = $singleInvoice->price - $singleInvoice->discount_value;
            $tot_after_tax = ($tot_before_tax * $singleInvoice->tax_rate) / 100;
            $final = $tot_after_tax + $tot_before_tax;

            // حفظ القيمة النهائية مع الضريبة
            $singleInvoice->tot_with_tax = $final;
            $singleInvoice->type = $request->type;

            // حفظ الفاتورة
            $singleInvoice->save();

            // معالجة الحسابات بناءً على نوع الفاتورة
            if ($singleInvoice->type == 1) {
                // حذف حساب المريض إذا كان موجوداً
                $patient_account = PatientAccount::where('single_invoice_id', $singleInvoice->id)->first();
                if ($patient_account) {
                    $patient_account->delete();
                }

                // تحديث أو إنشاء سجل الصندوق
                $fundSchedule = Fund_Schedule::firstOrCreate(
                    ['single_invoice_id' => $singleInvoice->id],
                    [
                     'debit' => $singleInvoice->tot_with_tax,
                     'credit' => 0.00,
                     'date' => $singleInvoice->invoice_date
                    ]
                );


            } else {
                // حذف سجل الصندوق إذا كان موجوداً
                $fundSchedule = Fund_Schedule::where('single_invoice_id', $singleInvoice->id)->first();
                if ($fundSchedule) {
                    $fundSchedule->delete();
                }

                // تحديث أو إنشاء حساب المريض
                $patient_account = PatientAccount::firstOrCreate(
                    ['single_invoice_id' => $singleInvoice->id],
                    [
                        'patient_id' => $singleInvoice->patient_id,
                        'debit' => $singleInvoice->tot_with_tax,
                        'credit' => 0.00,
                        'date' => $singleInvoice->invoice_date
                    ]
                );
                $patient_account->debit=$singleInvoice->tot_with_tax;
                $patient_account->save();
            }


            // تأكيد المعاملة
            DB::commit();
            session()->flash('edit');
            Mail::to($singleInvoice->patient->email)->send(new SendInvoiceMail($singleInvoice));
            return redirect()->route('single-invoices.index');

        } catch (Exception $e) {
            // التراجع عن المعاملة في حال حدوث خطأ
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function destroy($id)
        {
          $singleInvoice=SingleInvoice::findOrFail($id);
          $singleInvoice->delete();
          session()->flash('delete');
          return back();
         }


         public function show($id){
            $singleInvoice=SingleInvoice::findOrFail($id);
            return view('Dashboard.Invoices.show',compact('singleInvoice'));
         }

         

}
