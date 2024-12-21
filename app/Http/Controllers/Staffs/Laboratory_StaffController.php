<?php

namespace App\Http\Controllers\Staffs;

use App\Http\Controllers\Controller;
use App\Interfaces\Staffs\LaboratoryInterface;
use Illuminate\Http\Request;

class Laboratory_StaffController extends Controller
{
    protected $laboratory;
    public  function __construct(LaboratoryInterface  $laboratory)
    {
        $this->laboratory = $laboratory;
    }

    public function index(){

        return $this->laboratory->index();
    }

    public function update(Request $request,$id){
        return $this->laboratory->update($request,$id);
    }

    public  function  edit($id)
    {
        return $this->laboratory->edit($id);
    }

    public function show()
    {
        return $this->laboratory->show();
    }

    public function getIformation($id)
    {
        return $this->laboratory->getLaboratoryInformation($id);
    }
}
