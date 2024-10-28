<?php

namespace App\Http\Controllers\Insurances;

use App\Http\Controllers\Controller;
use App\Interfaces\Insurances\InsuranceInterface;
use Illuminate\Http\Request;

class InsuranceController extends Controller
{
  protected $insurance;
  public function __construct(InsuranceInterface  $insurance)
  {
      $this->insurance=$insurance;
  }
  public function index()
  {
      return $this->insurance->index();
  }
  public  function  store(Request  $request)
  {
      return $this->insurance->store($request);
  }

  public function update($id,Request $request)
  {
      return $this->insurance->update($id,$request);
  }

  public function destroy($id)
  {
      return $this->insurance->destroy($id);
  }
}
