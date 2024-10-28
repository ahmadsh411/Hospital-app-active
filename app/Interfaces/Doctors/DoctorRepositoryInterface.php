<?php

namespace App\Interfaces\Doctors;

interface DoctorRepositoryInterface
{
    public  function index();
    public function create();

    public function store($request);

    public function destroy($request);

    public function edit($id);

    public function update($id,$request);

    public function  changepassword($request,$id);

    public  function changestatus($id,$request);


}
