<?php

namespace App\Repository\MedicalDiagnoses;

use App\Interfaces\MedicalDiagnoses\MedicalDiagnosesInterface;
use App\Models\Diagnoses\Diagnosis;
use App\Models\Invoices\OneTable\Invoice;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MedicalDiagnosesRepository implements MedicalDiagnosesInterface{


    public function store($request)
    {

        try{
            DB::beginTransaction();
           $medical= new Diagnosis();
           $medical->date=now();
           $medical->invoice_id=$request->invoice_id;
           $medical->patient_id=$request->patient_id;
           $medical->doctor_id=auth('doctor')->user()->id;
           $medical->medicals=$request->medicals;
           $medical->diagnoses_notes=$request->diagnoses;
           $medical->save();

           $invoice=Invoice::where('id',$medical->invoice_id)->firstOrFail();
           $invoice->invoice_status=1;
           $invoice->save();

           DB::commit();
           session()->flash('add');
           return back();

        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }

    }

    public function show($id){

        $medicals=Diagnosis::where('patient_id',$id)->get();
        return view('Dashboard.Doctors.DoctorDashboard.Invoices.show',compact('medicals'));
    }

    public function storeReview($request)
    {
        try{
            DB::beginTransaction();
            $medical= new Diagnosis();
            $medical->date=now();
            $medical->invoice_id=$request->invoice_id;
            $medical->patient_id=$request->patient_id;
            $medical->doctor_id=auth('doctor')->user()->id;
            $medical->medicals=$request->medicals;
            $medical->diagnoses_notes=$request->diagnoses;
            $medical->review_date = Carbon::parse($request->review_date)->format('Y-m-d');
            $medical->save();

            $invoice=Invoice::where('id',$medical->invoice_id)->firstOrFail();
            $invoice->invoice_status=2;
            $invoice->save();

            DB::commit();
            session()->flash('add');
            return back();

        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
    }
}
