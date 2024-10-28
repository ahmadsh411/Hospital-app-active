<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Interfaces\Service\single_service\Single_ServiceInterface;
use Illuminate\Http\Request;

class SingleServiceController extends Controller
{
    protected  $single_service;
    public function __construct(Single_ServiceInterface $single_service)
    {
        $this->single_service=$single_service;
    }

    public function index()
    {
        return $this->single_service->index();
    }
    //######store_method###########################################
    public function  store(Request  $request)
    {
        return $this->single_service->store($request);
    }
    //update method#################
    public function update(Request $request){
        return $this->single_service->update($request);
    }
//##############destroyMethod##############
    public function destroy(Request $request)
    {
    return $this->single_service->destroy($request);
    }
}
