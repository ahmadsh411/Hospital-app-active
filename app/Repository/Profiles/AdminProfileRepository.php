<?php

namespace App\Repository\Profiles;

use App\Interfaces\Profiles\AdminProfileInterface;
use Exception;
use Illuminate\Support\Facades\Hash;

class AdminProfileRepository implements  AdminProfileInterface{

    public function show()
    {
        $admin=auth('admin')->user();
        return view('Dashboard.Admin.profiles.show',compact('admin'));
    }

    public function edit()
    {
        $admin=auth('admin')->user();
          return view('Dashboard.Admin.profiles.edit',compact('admin'));
    }

    public function update($request)
    {
       try{
        
        $admin=auth('admin')->user();
        $admin->name=$request->name;
        $admin->email=$request->email;
        if($request->input('password')){
            $admin->password=Hash::make($request->password);
        }
        $admin->save();

        session()->flash('add');
        return redirect()->route('profile.show');

       }catch(Exception $r){
        return redirect()->back()->withErrors(['error'=>$r->getMessage()]);
       }
    }
}
