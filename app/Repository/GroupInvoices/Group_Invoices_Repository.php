<?php

namespace App\Repository\GroupInvoices;

use App\Interfaces\GroupInvoices\Group_Invoices_Interface;
use App\Mail\SendGroupInvoiceMail;
use App\Mail\UpdateGroupInvoiceMail;
use App\Models\Boxes\Fund_Schedule;
use App\Models\Boxes\PatientAccount;
use App\Models\Doctors\Doctor;
use App\Models\Invoices\Group_Invoice;
use App\Models\Patients\Patient;
use App\Models\Sections\Section;
use App\Models\Service\MultiService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class Group_Invoices_Repository implements Group_Invoices_Interface{

    public function index()
    {
       $groups=Group_Invoice::all();
       $patients=Patient::all();
       $doctors=Doctor::all();
       $sections=Section::all();
       $services=MultiService::all();
       return view('Dashboard.Invoices.GroupInvoices.index',compact('groups',
       'patients','doctors','sections','services'));

    }

    public function store($request)
    {
       try{
        DB::beginTransaction();
        $groupInvoice=new Group_Invoice();
        $groupInvoice->invoice_date	=now()	;
        $groupInvoice->patient_id=$request->patient_id;
        $groupInvoice->	doctor_id=$request->doctor_id;
        $groupInvoice->section_id=$request->section_id;
        $groupInvoice->group_id=$request->service_id;
        $groupInvoice->price=$request->price;
        $groupInvoice->discount_value=$request->discount_value;
        $groupInvoice->tax_rate=$request->tax_rate;
        $groupInvoice->tax_value=$request->tax_value;
        $tot_befor_discount=$request->price - $request->discount_value;
        $tot_after_discount=($tot_befor_discount*$request->tax_rate)/100;
        $final=$tot_after_discount+$tot_befor_discount;
        $groupInvoice->tot_with_tax=$final;
        $groupInvoice->type=$request->type;
        $groupInvoice->save();

        //تكون مدفوعه
        if($groupInvoice->type==1){

            $funcShedule=new Fund_Schedule();
            $funcShedule->date=now();
            $funcShedule->group_invoice_id=$groupInvoice->id;
            $funcShedule->credit=0.00;
            $funcShedule->debit= $groupInvoice->tot_with_tax;
            $funcShedule->save();
        }else{
            $patient_account= new PatientAccount();
            $patient_account->date=now();
            $patient_account->group_invoice_id=$groupInvoice->id;
            $patient_account->patient_id=$groupInvoice->patient_id;
            $patient_account->debit	= $groupInvoice->tot_with_tax;
            $patient_account->credit=0.00;
            $patient_account->save();
        }

        Mail::to($groupInvoice->patient->email)->send(new SendGroupInvoiceMail($groupInvoice));
        DB::commit();
        session()->flash('add');
        return back();
       }catch(Exception $e){
        return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
       }

    }


    public function edit($id){

        $group=Group_Invoice::findOrFail($id);
       $patients=Patient::all();
       $doctors=Doctor::all();
       $sections=Section::all();
       $services=MultiService::all();
       return view('Dashboard.Invoices.GroupInvoices.update',compact('group',
       'patients','doctors','sections','services'));
    }

    public function update($id, $request)
    {
        try{
            DB::beginTransaction();
            $groupInvoice=Group_Invoice::findOrFail($id);
            $groupInvoice->patient_id=$request->patient_id;
            $groupInvoice->	doctor_id=$request->doctor_id;
            $groupInvoice->section_id=$request->section_id;
            $groupInvoice->group_id=$request->service_id;
            $groupInvoice->price=$request->price;
            $groupInvoice->discount_value=$request->discount_value;
            $groupInvoice->tax_rate=$request->tax_rate;
            $groupInvoice->tax_value=$request->tax_value;
            $tot_befor_discount=$request->price - $request->discount_value;
            $tot_after_discount=($tot_befor_discount*$request->tax_rate)/100;
            $final=$tot_after_discount+$tot_befor_discount;
            $groupInvoice->tot_with_tax=$final;
            $groupInvoice->type=$request->type;
            $groupInvoice->save();

            //تكون مدفوعه
            if($groupInvoice->type==1){
                $funcShedule=Fund_Schedule::where('group_invoice_id',$id)->firstOrFail();
                $funcShedule->group_invoice_id=$groupInvoice->id;
                $funcShedule->credit=0.00;
                $funcShedule->debit=$groupInvoice->tot_with_tax;
                $funcShedule->save();
            }else{
                $funcShedule=Fund_Schedule::where('group_invoice_id',$id)->first();
                if($funcShedule){
                    $funcShedule->delete();
                }
                $patient_account = PatientAccount::firstOrCreate(
                    ['group_invoice_id' => $groupInvoice->id],
                    [
                        'date' => $groupInvoice->invoice_date,
                        'debit' => $groupInvoice->tot_with_tax,
                        'credit' => 0.00,
                        'patient_id' => $groupInvoice->patient_id,
                    ]
                );

                // تحديث حقل "debit" في حال السجل موجود مسبقاً
                $patient_account->debit = $groupInvoice->tot_with_tax;
                $patient_account->save();


                $patient_account->save();
            }

            Mail::to($groupInvoice->patient->email)->send(new UpdateGroupInvoiceMail($groupInvoice));
            DB::commit();
            session()->flash('edit');
            return redirect()->route('group-invoices.index');
           }catch(Exception $e){
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
           }

    }

    public function destroy($id)
    {
        $groupInvoice=Group_Invoice::findOrFail($id);
        $groupInvoice->delete();
        session()->flash('delete');
        return back();
    }

    public function show($id){
        $groupInvoice=Group_Invoice::findOrFail($id);
        return view('Dashboard.Invoices.GroupInvoices.show',compact('groupInvoice'));
    }
}

