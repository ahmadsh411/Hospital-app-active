<?php

namespace App\Interfaces\Staffs;

interface StaffInterface
{
    public function index();

    public function store($request);

    public function edit($id);

    public function update($request, $id);

    public function destroy($id);

}
