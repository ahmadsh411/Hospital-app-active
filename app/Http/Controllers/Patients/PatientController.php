<?php

namespace App\Http\Controllers\Patients;

use App\Http\Controllers\Controller;
use App\Interfaces\Patients\PatientInterface;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    protected $Patient;
    public function __construct(PatientInterface $Patient)
    {
        $this->Patient=$Patient;
    }

    public function index()
    {
        return $this->Patient->index();
    }

    public function show($id)
    {
       return $this->Patient->show($id);
    }
    public function store(Request $request)
    {
        return $this->Patient->store($request);
    }

    public function update($id, Request $request)
    {
        return $this->Patient->update($id,$request);
    }

    public  function destroy($id)
    {
        return $this->Patient->destroy($id);
    }

}
