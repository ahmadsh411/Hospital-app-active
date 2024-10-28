<?php

namespace App\Interfaces\Rays;

interface  RayInterface{

    public  function  store($request);
//
    public function edit($id);

    public function update($id,$request);

    public  function  delete($id);

    public  function  show($id);




}

