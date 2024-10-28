<?php

namespace App\Interfaces\MedicalDiagnoses;


interface MedicalDiagnosesInterface{

    public function store($request);

    public function show($id);

    public function  storeReview($request);
}
