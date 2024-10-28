<?php

namespace App\Interfaces\Profiles;

interface DoctorProfileInterface{

    public function show();

    public function update($request);

    public function edit();
}
