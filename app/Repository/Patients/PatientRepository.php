<?php
namespace App\Repository\Patients;
use App\Interfaces\Patients\PatientInterface;
use App\Mail\JoinPatientsMail;
use App\Models\Bloods\BloodType;
use App\Models\Boxes\PatientAccount;
use App\Models\Boxes\Receipt;
use App\Models\Genders\Gender;
use App\Models\Invoices\SingleInvoice;
use App\Models\Patients\Patient;
use Illuminate\Support\Facades\Mail;
use Mockery\Exception;

class PatientRepository implements PatientInterface
{

    public function index()
    {
       $patients=Patient::all();
       $genders=Gender::all();
       $blood_types=BloodType::all();
       return view('Dashboard.Patients.index',compact('patients','genders','blood_types'));
    }

    public function store($request)
    {
        try{
            $patient=new Patient();
            $patient->name=$request->name;
            $patient->address=$request->address;
            $patient->email=$request->email;
            $patient->id_number=$request->id_number;
            $patient->phone=$request->phone;
            $patient->date_of_birth=$request->date_of_birth;
            $patient->gender_id=$request->gender_id;
            $patient->blood_id=$request->blood_id;
            $patient->save();
            Mail::to($patient->email)->send(new JoinPatientsMail($patient));
            session()->flash('add');
            return redirect()->back();
        }catch (Exception $e){
            return redirect()->back()->withErrors('error',$e->getMessage());
        }
    }

    public function update($id, $request)
    {
        try{
            $patient=Patient::findOrFail($id);
            $patient->name=$request->name;
            $patient->address=$request->address;
            $patient->email=$request->email;
            $patient->id_number=$request->id_number;
            $patient->phone=$request->phone;
            $patient->date_of_birth=$request->date_of_birth;
            $patient->gender_id=$request->gender_id;
            $patient->blood_id=$request->blood_id;
            $patient->save();
            session()->flash('edit');
            return redirect()->back();
        }catch (Exception $e){
            return redirect()->back()->withErrors('error',$e->getMessage());
        }
    }

    public function destroy($id)
    {
        $patient=Patient::findOrFail($id);
        $patient->delete();
        session()->flash('delete');
        return redirect()->back();
    }

    public function show($id)
    {
        $Patient=Patient::findOrFail($id);
        $invoices=$Patient->invoices;
        $receipt_accounts=$Patient->receipt;
        $Patient_accounts=$Patient->patientAccount;
        return view('Dashboard.Patients.show',
        compact('Patient','invoices','receipt_accounts','Patient_accounts'));
    }
}
