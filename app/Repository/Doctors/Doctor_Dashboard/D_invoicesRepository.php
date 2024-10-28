<?php

namespace App\Repository\Doctors\Doctor_Dashboard;

use App\Interfaces\Doctors\Doctor_Dashboard\D_invoicesInterfaces;
use App\Models\Diagnoses\Diagnosis;

class  D_invoicesRepository implements D_invoicesInterfaces{

    public function index(){
        $doctor=auth('doctor')->user();
        // $section=$doctor->section;
        // $appointments=$doctor->appointments;
        $invoices=$doctor->allinvoices->where('invoice_status',0);
        return view('Dashboard.Doctors.DoctorDashboard.Invoices.index',compact('invoices'));

    }

    public function completeIndex()
    {
        $doctor=auth('doctor')->user();
        $invoices=$doctor->allinvoices->where('invoice_status',1);
        return view('Dashboard.Doctors.DoctorDashboard.Invoices.index',compact('invoices'));

    }

    public function reviews(){
        $doctor=auth('doctor')->user();
        $invoices=$doctor->allinvoices->where('invoice_status',2);

        return view('Dashboard.Doctors.DoctorDashboard.Invoices.index',compact('invoices'));
    }



}
