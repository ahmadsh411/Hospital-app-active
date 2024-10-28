<?php

namespace App\Http\Controllers\Doctor\Doctor_Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Doctors\Doctor_Dashboard\D_invoicesInterfaces;
use Illuminate\Http\Request;

class DoctorInvoicesController extends Controller
{

    protected $doctor;

    public function __construct(D_invoicesInterfaces $doctor)
    {
       $this->doctor=$doctor;
    }


    public function index()
    {
        return $this->doctor->index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public  function completeIndex(){
        return $this->doctor->completeIndex();
    }

    public function reviews(){
        return $this->doctor->reviews();
    }
}
