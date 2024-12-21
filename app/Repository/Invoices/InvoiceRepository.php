<?php

namespace App\Repository\Invoices;

use App\Events\Create_Event;
use App\Events\create_Invoice;
use App\Events\MyEvent;
use App\Interfaces\Invoices\InvoiceInterface;
use App\Mail\SendInvoiceMail;
use App\Models\Boxes\Fund_Schedule;
use App\Models\Boxes\PatientAccount;
use App\Models\Doctors\Doctor;
use App\Models\Invoices\OneTable\Invoice;
use App\Models\Notifications\Notification;
use App\Models\Patients\Patient;
use App\Models\Sections\Section;
use App\Models\Service\MultiService;
use App\Models\Service\SingleService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class InvoiceRepository implements InvoiceInterface
{

    public function index()
    {
        $singleInvoices = Invoice::all();
        $patients = Patient::all();
        $doctors = Doctor::all();
        $sections = Section::all();
        $services = SingleService::all();
        $groups = MultiService::all();
        return view('Dashboard.Invoices.AllInvoices.index',
            compact('singleInvoices', 'patients', 'doctors'
                , 'sections', 'services', 'groups'));
    }


    public function create()
    {

    }


    public function store($request)
    {

        try {
            DB::beginTransaction();
            $singleInvoice = new Invoice();
            $singleInvoice->invoice_date = now();
            $singleInvoice->patient_id = $request->patient_id;
            $singleInvoice->doctor_id = $request->doctor_id;
            $singleInvoice->section_id = $request->section_id;
            $singleInvoice->service_id = $request->service_id;
            $singleInvoice->group_id = $request->group_id;
            if ($request->filled('group_id')) {
                $singleInvoice->invoice_type = 1; // Grouped service
            } elseif ($request->filled('service_id')) {
                $singleInvoice->invoice_type = 0; // Single service
            }
            $singleInvoice->price = $request->price;
            $singleInvoice->discount_value = $request->discount_value;
            $singleInvoice->tax_rate = $request->tax_rate;
            $singleInvoice->tax_value = $request->tax_value;
            $tot_before_tax = $request->price - $request->discount_value;//3500
            $tot_after_tax = ($tot_before_tax * ($request->tax_rate)) / 100;//1500
            $final = $tot_after_tax + $tot_before_tax;
            $singleInvoice->tot_with_tax = $final;
            $singleInvoice->type = $request->type;
            $singleInvoice->invoice_status = $request->invoice_status;
            $singleInvoice->save();
            if ($singleInvoice->type == 1) {
                //حفظ في جدول الفواتير
                //حفظ في جدول الصندوق
                $fundschedules = new Fund_Schedule();
                $fundschedules->date = now();
                $fundschedules->invoice_id = $singleInvoice->id;
                $fundschedules->credit = 0.00;
                $fundschedules->debit = $singleInvoice->tot_with_tax;
                $fundschedules->save();
                //ارسال رسالة تتصمن للسمتخم تعريفه بانه دفع

                $notification = new Notification();
                $notification->user_id = $singleInvoice->doctor_id;
                $notification->read_status = 0;
                $notification->message = " دفع فاتورة";
                $notification->save();


                event(new create_Invoice(
                    $singleInvoice->doctor_id,
                    'تم دفع الفاتورة بنجاح',
                    $singleInvoice->tot_with_tax,
                    $singleInvoice->patient->name,
                    $singleInvoice->created_at->format('Y-m-d h:i'),
                ));




            } else {
                //حفظ في جدول الفواتير
                //حفظ في جدول حسابات المريض
                $patient_account = new PatientAccount();
                $patient_account->date = now();
                $patient_account->invoice_id = $singleInvoice->id;
                $patient_account->patient_id = $singleInvoice->patient->id;
                $patient_account->debit = $singleInvoice->tot_with_tax;
                $patient_account->credit = 0.00;
                $patient_account->save();
                //اظهار رساله للمستخدم بانه لم يدفع

            }
            DB::commit();
            Mail::to($singleInvoice->patient->email)->send(new SendInvoiceMail($singleInvoice));
            session()->flash('add');
            return back();


        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function edit($id)
    {
        $singleInvoice = Invoice::findOrFail($id);
        $patients = Patient::all();
        $doctors = Doctor::all();
        $sections = Section::all();
        $services = SingleService::all();
        $groups = MultiService::all();

        return view('Dashboard.Invoices.AllInvoices.update', compact('singleInvoice', 'patients', 'doctors'
            , 'sections', 'services', 'groups'));
    }

    public function update($id, $request)
    {

        try {
            DB::beginTransaction();
            $singleInvoice = Invoice::findOrFail($id);
            // $singleInvoice->invoice_date=now();
            $singleInvoice->patient_id = $request->patient_id;
            $singleInvoice->doctor_id = $request->doctor_id;
            $singleInvoice->section_id = $request->section_id;
            $singleInvoice->service_id = $request->service_id;
            $singleInvoice->group_id = $request->group_id;
            if ($request->filled('group_id')) {
                $singleInvoice->invoice_type = 1; // Grouped service
            } elseif ($request->filled('service_id')) {
                $singleInvoice->invoice_type = 0; // Single service
            }

            $singleInvoice->price = $request->price;
            $singleInvoice->discount_value = $request->discount_value;
            $singleInvoice->tax_rate = $request->tax_rate;
            $singleInvoice->tax_value = $request->tax_value;
            $tot_before_tax = $request->price - $request->discount_value;//3500
            $tot_after_tax = ($tot_before_tax * ($request->tax_rate)) / 100;//1500
            $final = $tot_after_tax + $tot_before_tax;
            $singleInvoice->tot_with_tax = $final;
            $singleInvoice->type = $request->type;
            $singleInvoice->invoice_status = $request->invoice_status;
            $singleInvoice->save();
            if ($singleInvoice->type == 1) {
                //حفظ في جدول الفواتير
                //حفظ في جدول الصندوق

                $patient_account = PatientAccount::where('invoice-id', $id)->first();
                if ($patient_account) {
                    $patient_account->delete();
                }
                $fundschedules = Fund_Schedule::firstOrCreate(
                    ['invoice_id' => $singleInvoice->id],
                    [
                        'credit' => 0.00,
                        'debit' => $singleInvoice->tot_with_tax,
                        'date' => $singleInvoice->invoice_date,

                    ],


                );

                //ارسال رسالة تتصمن للسمتخم تعريفه بانه دفع


            } else {
                $fundschedules = Fund_Schedule::where('invoice_id', $id)->first();
                if ($fundschedules) {
                    $fundschedules->delete();
                }
                //حفظ في جدول حسابات المريض
                $patient_account = PatientAccount::firstOrCreate(
                    ['invoice_id' => $singleInvoice->id],
                    [
                        'patient_id' => $singleInvoice->patient_id,
                        'debit' => $singleInvoice->tot_with_tax,
                        'credit' => 0.00,
                        'date' => $singleInvoice->invoice_date
                    ]
                );
                $patient_account->debit = $singleInvoice->tot_with_tax;
                $patient_account->save();
                //اظهار رساله للمستخدم بانه لم يدفع

            }
            DB::commit();
            Mail::to($singleInvoice->patient->email)->send(new SendInvoiceMail($singleInvoice));
            session()->flash('edit');
            return redirect()->route('invoices.index');


        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function destroy($id)
    {

        $singleInvoice = Invoice::findOrFail($id);
        $singleInvoice->delete();
        session()->flash('delete');
        return back();
    }

    public function show($id)
    {
        $singleInvoice = Invoice::findOrFail($id);
        return view('Dashboard.Invoices.AllInvoices.show', compact('singleInvoice'));
    }

}
