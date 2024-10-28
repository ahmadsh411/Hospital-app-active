<?php
namespace  App\Repository\Ambulances;

use App\Interfaces\Ambulances\AmbulanceInterface;
use App\Models\Ambulances\Ambulance;

class AmbulanceRepository implements AmbulanceInterface
{

    public function index()
    {
        $ambulances=Ambulance::all();
        return view('Dashboard.Ambulances.index',compact('ambulances'));

    }

    public function store($request)
    {
        try{
              $ambulace=new Ambulance();
              $ambulace->name=$request->driver_name;
              $ambulace->notes=$request->notes;
              $ambulace->car_number=$request->car_number;
              $ambulace->car_model=$request->car_model;
              $ambulace->date_of_manufacture=$request->date_of_manufacture;
              $ambulace->type=$request->type;
              $ambulace->license_number=$request->license_number;
              $ambulace->phone_number=$request->phone_number;
              $ambulace->save();
              session()->flash('add');
              return redirect()->back();
        }catch(Exception $e){
            return redirect()->back()->withErrors('error',$e->getMessage());
        }
    }

    public function update($id, $request)
    {
        try{
            $ambulace=Ambulance::findOrFail($id);
            $ambulace->name=$request->driver_name;
            $ambulace->notes=$request->notes;
            $ambulace->car_number=$request->car_number;
            $ambulace->car_model=$request->car_model;
            $ambulace->date_of_manufacture=$request->date_of_manufacture;
            $ambulace->type=$request->type;
            $ambulace->license_number=$request->license_number;
            $ambulace->phone_number=$request->phone_number;
            $ambulace->save();
            session()->flash('edit');
            return redirect()->back();
        }catch(Exception $e){
            return redirect()->back()->withErrors('error',$e->getMessage());
        }
    }

    public function destroy($id)
    {
        $ambulace=Ambulance::findOrFail($id);
        $ambulace->delete();
        session()->flash('delete');
        return redirect()->back();
    }
}
