<?php

namespace App\Http\Controllers\Doctor\Doctor_Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Rays\RayInterface;
use Illuminate\Http\Request;

class RayDoctorController extends Controller
{
    protected $ray;

    public function __construct(RayInterface $ray){
        $this->ray=$ray;
    }

    public function  store(Request  $request){
        return $this->ray->store($request);
    }
    public  function edit($id){
      return $this->ray->edit($id);
    }

    public function  update($id,Request  $request){
        return $this->ray->update($id,$request);
    }
    public  function destroy($id){
        return $this->ray->delete($id);
    }

    public  function show($id){
        return $this->ray->show($id);
    }


}
