<?php
namespace  App\Interfaces\Ambulances;

interface  AmbulanceInterface
{
 public  function index();
 public function store($request);
 public function update($id,$request);
 public function destroy($id);
}
