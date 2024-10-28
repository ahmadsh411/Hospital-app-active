<?php
namespace App\Interfaces\Insurances;

interface InsuranceInterface
{
  public function index();
  public function store($request);

  public function update($id,$request);

  public  function destroy($id);

}
