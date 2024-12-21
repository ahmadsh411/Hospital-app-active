<?php

namespace App\Http\Livewire\Chat\Staff;

use Livewire\Component;

class Main extends Component
{


    public $message;

    public function sendMessage()
    {

    }

    public function render()
    {

        return view('livewire.chat.Staff.main')->extends('Dashboard.layouts.Staff.master_staff');
    }
}
