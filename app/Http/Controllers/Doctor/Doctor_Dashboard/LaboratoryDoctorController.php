<?php

namespace App\Http\Controllers\Doctor\Doctor_Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Laboratories\LaboratoryInterface;
use App\Models\Laboratories\Laboratory;
use Illuminate\Http\Request;

class LaboratoryDoctorController extends Controller
{
    protected $laboratory;

    public function __construct(LaboratoryInterface $laboratory){

        $this->laboratory = $laboratory;
    }


    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        return $this->laboratory->store($request);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        return $this->laboratory->edit($id);
    }


    public function update($id,Request $request)
    {
        return $this->laboratory->update($request, $id);
    }


    public function destroy($id)
    {
        return $this->laboratory->delete($id);
    }
}
