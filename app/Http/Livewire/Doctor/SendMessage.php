<?php

namespace App\Http\Livewire\Doctor;

use Livewire\Component;

class SendMessage extends Component
{
    public function render()
    {
        return view('livewire.doctor.send-message')->extends('Dashboard.layouts.Doctor.master_doctor');
    }
}
