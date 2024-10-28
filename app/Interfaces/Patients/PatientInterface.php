<?php
namespace App\Interfaces\Patients;
interface PatientInterface
{

    public function index();

    public function store($request);

    public function update($id,$request);

    public function destroy($id);

    public function show($id);

}
