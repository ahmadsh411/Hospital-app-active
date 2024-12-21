<?php

namespace App\Interfaces\Staffs;

interface LaboratoryInterface{

    public function  index();

    public function  show();

    public function  update($request,$id);

    public function  edit($id);

    public function getLaboratoryInformation($id);
}
