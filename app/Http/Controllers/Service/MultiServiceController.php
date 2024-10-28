<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Interfaces\Service\multi_services\Multi_serviceInterface;
use Illuminate\Http\Request;

class MultiServiceController extends Controller
{
    private $multiservices;
    public function __construct(Multi_serviceInterface  $multi_service)
    {
        $this->multiservices=$multi_service;
    }

    public function index()
    {
       return $this->multiservices->index();
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        return $this->multiservices->store($request);
    }


    public function edit($id)
    {
        return $this->multiservices->edit($id);
    }


    public function update(Request $request, $id)
    {
        return  $this->multiservices->update($request, $id);
    }


    public function destroy(Request  $request)
    {
       return $this->multiservices->destroy($request);
    }
}
