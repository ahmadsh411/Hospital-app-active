<?php
namespace  App\Interfaces\Service\single_service;
interface Single_ServiceInterface
{
 public  function  index();

 public  function store($request);

 public function update($request);

 public  function destroy($request);

}
