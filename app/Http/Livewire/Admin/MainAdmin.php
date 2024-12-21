<?php

namespace App\Http\Livewire\Admin;

use App\Models\Conversations\Conversation;
use App\Models\Messages\Chat;
use Livewire\Component;

class MainAdmin extends Component
{

    public function render()
    {
        return view('livewire.admin.main-admin')->extends('Dashboard.layouts.Admin.master');
    }
}
