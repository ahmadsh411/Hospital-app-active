<?php

namespace App\Repository\SingleInvoice;

use App\Interfaces\SingleInvoice\spending_moneyInterface;
use App\Mail\MonyBackmail;
use App\Mail\UpdateMoyBackMail;
use App\Models\Boxes\Fund_Schedule;
use App\Models\Boxes\Paiment;
use App\Models\Boxes\PatientAccount;
use App\Models\Patients\Patient;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class spending_moneyRepository implements  spending_moneyInterface{
    public function index()
    {
        $payments=Paiment::all();
        $patients=Patient::all();
        return view('Dashboard.Payments.index',compact('payments','patients'));

    }

    public function store($request)
    {

        try{

            DB::beginTransaction();
            //ألحفظ في جدول  سندات الصرف
            $payment=new Paiment();
            $payment->date=$request->date;
            $payment->patient_id=$request->patient_id;
            $payment->debit=$request->debit;
            $payment->description=$request->description;
            $payment->save();

            //الحفظ في جدول الصندوق دائن

            $func_shedule= new Fund_Schedule();
            $func_shedule->date=$request->date;
            $func_shedule->paiment_id=$payment->id;
            $func_shedule->credit=$request->debit;
            $func_shedule->debit=0.00;
            $func_shedule->save();

            // الحفظ في جدول حسابات النستخدم مدين

            $patientAccount=new PatientAccount();
            $patientAccount->date=$request->date;
            $patientAccount->patient_id=$request->patient_id;
            $patientAccount->payment_id=$payment->id;
            $patientAccount->debit=$request->debit;
            $patientAccount->save();

            $rest1=PatientAccount::where('patient_id',$request->patient_id)->sum('debit')-PatientAccount::where('patient_id',$request->patient_id)->sum('credit');
            $rest=abs($rest1);
            if($rest1<0){
                Mail::to($payment->patient->email)->send(new MonyBackmail($payment,$rest));
            }else{
                Mail::to($payment->patient->email)->send(new MonyBackmail($payment,$rest1));
            }
            DB::commit();
            // رسالة لايميل المتخدملاعادة الرسوم

            session()->flash('add');
            return back();




        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }

    }

    public function edit($id)
    {
          $payment=Paiment::findOrFail($id);
          $patients=Patient::all();
          return view('Dashboard.Payments.update',compact('patients','payment'));

    }

    public function update($id,$request)
    {

        try{
            DB::beginTransaction();

            $payment=Paiment::findOrFail($id);
            $payment->patient_id=$request->patient_id;
            $payment->debit=$request->debit;
            $payment->description=$request->description;
            $payment->save();

            //تجديث البيانات بجدول الصندوق

            $func_shedule=Fund_Schedule::where('paiment_id',$id)->firstOrFail();
            $func_shedule->paiment_id=$payment->id;
            $func_shedule->credit=$request->debit;
            $func_shedule->debit=0.00;
            $func_shedule->save();

            //تحديث المعلومات في جدول المستخدمين

            $patientAccount=PatientAccount::where('payment_id',$id)->firstOrFail();
            $patientAccount->patient_id=$request->patient_id;
            $patientAccount->payment_id=$payment->id;
            $patientAccount->debit=$request->debit;
            $patientAccount->save();
            $rest1=PatientAccount::where('patient_id',$request->patient_id)->sum('debit')-PatientAccount::where('patient_id',$request->patient_id)->sum('credit');
             $rest=abs($rest1);
            Mail::to($payment->patient->email)->send(new UpdateMoyBackMail($payment,$rest));
            DB::commit();
             session()->flash('edit');
             return redirect()->route('paiment-box.index');



        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $payment=Paiment::findOrFail($id);
        $payment->delete();
        session()->flash('delete');
        return back();
    }

    public function show($id){
        $payment=Paiment::findOrFail($id);
        return view('Dashboard.Payments.show',compact('payment'));
    }
}
