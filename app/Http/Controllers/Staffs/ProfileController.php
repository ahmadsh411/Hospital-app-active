<?php

namespace App\Http\Controllers\Staffs;

use App\Http\Controllers\Controller;
use App\Interfaces\Profiles\staffprofileInterface;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $profile;
    public function __construct(staffprofileInterface $profile)
    {
          $this->profile = $profile;
    }

    public function show(){
        return $this->profile->show();
    }
    public function edit(){
        return $this->profile->edit();
    }


    public function update(Request $request){
        return $this->profile->update($request);
    }
}
