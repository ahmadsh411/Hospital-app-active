<?php
namespace App\Interfaces\Service\multi_services;
interface Multi_serviceInterface
{
  public  function index();
  public  function store($request);

  public  function update($request,$id);


  public function edit($id);

    public function destroy($request);
}
