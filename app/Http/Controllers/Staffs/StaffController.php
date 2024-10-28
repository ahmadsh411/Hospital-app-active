<?php

namespace App\Http\Controllers\Staffs;

use App\Http\Controllers\Controller;
use App\Interfaces\Staffs\StaffInterface;
use App\Repositories\Staffs\StaffRepository;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    protected $staff;

    public function __construct(StaffInterface $staff){
        $this->staff = $staff;
    }
    public function index()
    {
        return $this->staff->index();
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        return $this->staff->store($request);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        return $this->staff->edit($id);
    }


    public function update(Request $request, $id)
    {
        return $this->staff->update($request, $id);
    }


    public function destroy($id)
    {
        return $this->staff->destroy($id);
    }
}
