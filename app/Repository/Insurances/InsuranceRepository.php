<?php
namespace App\Repository\Insurances;

use App\Interfaces\Insurances\InsuranceInterface;
use App\Mail\CompanyMail;
use App\Models\Insurances\Insurance;
use Illuminate\Support\Facades\Mail;
use Mockery\Exception;

class InsuranceRepository implements InsuranceInterface
{
    public function index()
    {
        $insurances=Insurance::all();
        return view('Dashboard.Insurances.index',compact('insurances'));
    }

    public function store($request)
    {
        try {
            $insurance=new Insurance();
            $insurance->company_name=$request->name;
            $insurance->notes=$request->notes;
            $insurance-> company_code=$request->code;
            $insurance->company_email=$request->email;
            $insurance->patient_tolerance=$request->patient_tolerance;
            $insurance->company_rate=$request->company_rate;
            $insurance->status=$request->status;
            $insurance->save();
            Mail::to($insurance->company_email)->send(new CompanyMail($insurance->company_name,$insurance->status,$insurance->company_rate));
            
            session()->flash('add');
            return redirect()->back();
        }catch (Exception $e){
            return redirect()->back()->withErrors('error',$e->getMessage());
        }
    }

    public function update($id, $request)
    {
        try {
            $insurance=Insurance::findOrFail($id);
            $insurance->company_name=$request->name;
            $insurance->notes=$request->notes;
            $insurance-> company_code=$request->code;
            $insurance->company_email=$request->email;
            $insurance->patient_tolerance=$request->patient_tolerance;
            $insurance->company_rate=$request->company_rate;
            $insurance->status=$request->status;
            $insurance->save();
            Mail::to($insurance->company_email)->send(new CompanyMail($insurance->company_name,$insurance->status,$insurance->company_rate));
            session()->flash('edit');
            return redirect()->back();
        }catch (Exception $e){
            return redirect()->back()->withErrors('error',$e->getMessage());
        }
    }
    // TODO: Implement destroy() method.
    public function destroy($id)
    {
        $insurance=Insurance::findOrFail($id);
        $insurance->delete();
        session()->flash('delete');
        return redirect()->back();

    }
}
