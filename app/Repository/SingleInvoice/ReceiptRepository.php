<?php

namespace App\Repository\SingleInvoice;

use App\Interfaces\SingleInvoice\ReceiptInterface;
use App\Mail\ResendReceiptMail;
use App\Mail\SendingReceptMail;
use App\Models\Boxes\Fund_Schedule;
use App\Models\Boxes\PatientAccount;
use App\Models\Boxes\Receipt;
use App\Models\Invoices\OneTable\Invoice;
use App\Models\Patients\Patient;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class  ReceiptRepository implements ReceiptInterface{

    public function index()
    {
        $receipts=Receipt::all();
        $patients=Patient::all();
        return view('Dashboard.Receipts.index',compact('receipts','patients'));
    }

    public function store($request)
    {
        try{
            DB::beginTransaction();

            //الحفظ بجدول سندات القبض

            $receipt=new Receipt();
            $receipt->date=$request->date;
            $receipt->patient_id=$request->patient_id;
            $receipt->debit=$request->debit;
            $receipt->description=$request->description;
            $receipt->save();

            //الحفظ في جدول الصندوق

            $fundshedule= new Fund_Schedule();
            $fundshedule->date=$request->date;
            $fundshedule->receipt_id=$receipt->id;
            $fundshedule->debit=$request->debit;
            $fundshedule->credit=0.00;
            $fundshedule->save();

            //الحفظ في جدول المريض

            $patientAccount= new PatientAccount();
            $patientAccount->date=$request->date;
            $patientAccount->patient_id=$request->patient_id;
            $patientAccount->receipt_id=$receipt->id;
            $patientAccount->debit=0.00;
            $patientAccount->credit=$request->debit;
            $patientAccount->save();

             $patient=Patient::where('id',$request->patient_id)->firstOrFail();
            $Accountaps =$patient->patientAccount->sum('debit')-$patient->patientAccount->sum('credit');
            
             if($Accountaps<0){
                Mail::to($patient->email)->send(new SendingReceptMail($receipt,$Accountaps));
             }else{
            $Account=abs($Accountaps);
            Mail::to($patient->email)->send(new SendingReceptMail($receipt,$Account));
             }
            DB::commit();
            session()->flash('add');
            return back();
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $receipt=Receipt::findOrFail($id);
        $patients=Patient::all();
        return view('Dashboard.Receipts.update',compact('receipt','patients'));
    }

    public function update($id, $request)
    {
        try{

            DB::beginTransaction();

            //الحفظ بجدول سندات القبض

            $receipt= Receipt::findOrFail($id);
            // $receipt->date=$request->date;
            $receipt->patient_id=$request->patient_id;
            $receipt->debit=$request->debit;
            $receipt->description=$request->description;
            $receipt->save();

            //الحفظ في جدول الصندوق

            $fundshedule= Fund_Schedule::where('receipt_id',$id)->firstOrFail();
            // $fundshedule->date=$request->date;
            $fundshedule->receipt_id=$receipt->id;
            $fundshedule->debit=$request->debit;
            $fundshedule->credit=0.00;
            $fundshedule->save();

            //الحفظ في جدول المريض

            $patientAccount=  PatientAccount::where('receipt_id',$id)->firstOrFail();
            // $patientAccount->date=$request->date;
            $patientAccount->patient_id=$request->patient_id;
            $patientAccount->receipt_id=$receipt->id;
            $patientAccount->debit=0.00;
            $patientAccount->credit=$request->debit;
            $patientAccount->save();

            $patient=Patient::where('id',$request->patient_id)->firstOrFail();
            $Accountaps =$patient->patientAccount->sum('debit')-$patient->patientAccount->sum('credit');

            $Account=abs($Accountaps);
            Mail::to($patient->email)->send(new ResendReceiptMail($receipt,$Account));

            DB::commit();
            session()->flash('edit');
            return redirect()->route('receipt-box.index');



        }catch(Exception $e){
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $receipt= Receipt::findOrFail($id);
        $receipt->delete();
        session()->flash('delete');
        return back();

    }

    public function show($id){
         $receipt=Receipt::findOrFail($id);
         return view('Dashboard.Receipts.show',compact('receipt'));
    }


}
