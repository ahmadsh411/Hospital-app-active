<?php

namespace App\Http\Controllers\Auth\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
 use  App\Interfaces\Profiles\AdminProfileInterface;
class ProfileController extends Controller
{
    protected  $admin;
    public function __construct(AdminProfileInterface $admin){
        $this->admin = $admin;
    }

    public function  show(){
        return $this->admin->show();
    }

    public function  edit()
    {
        return $this->admin->edit();
    }

    public function  update(Request $request)
    {
      return $this->admin->update($request);
    }
}
