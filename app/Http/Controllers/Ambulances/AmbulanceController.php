<?php

namespace App\Http\Controllers\Ambulances;

use App\Http\Controllers\Controller;
use App\Interfaces\Ambulances\AmbulanceInterface;
use Illuminate\Http\Request;

class AmbulanceController extends Controller
{
   protected $ambulance;
   public function __construct(AmbulanceInterface $ambulance)
   {
       $this->ambulance=$ambulance;
   }

   public function index()
   {
       return $this->ambulance->index();
   }
   public function store(Request $request)
   {
       return $this->ambulance->store($request);
   }
   public function update($id,Request $request)
   {
       return $this->ambulance->update($id,$request);
   }
   public function destroy($id)
   {
       return $this->ambulance->destroy($id);
   }
}
