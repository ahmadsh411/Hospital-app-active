<?php

namespace App\Http\Controllers\Doctor\Doctor_Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Patients\Patient;
use Illuminate\Http\Request;

class PatientDetailsController extends Controller
{
    public function index($id){
        $patient = Patient::find($id);
        $invoices=$patient->invoices;
        $receipt_accounts=$patient->receipt;
        $Patient_accounts=$patient->patientAccount;
        $patientRays=$patient->rayes;
        $patientLaboratories=$patient->laboratories;
        return view('Dashboard.Doctors.DoctorDashboard.Invoices.showPatientDetails',compact('patientLaboratories','patient',
            'invoices','receipt_accounts','Patient_accounts','patientRays'));
    }
}
