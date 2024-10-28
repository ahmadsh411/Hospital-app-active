<?php

namespace App\Http\Controllers\Invoices;

use App\Http\Controllers\Controller;
use App\Interfaces\SingleInvoice\ReceiptInterface;
use Illuminate\Http\Request;

class ReceiptConroller extends Controller
{
    protected $recept;
     public function __construct(ReceiptInterface $recept)
     {
         $this->recept=$recept;
     }

     public function index(){
        return $this->recept->index();
     }

     public function create(){
        //
     }

     public function store(Request $request){
         return $this->recept->store($request);
     }

     public function edit($id){
        return $this->recept->edit($id);
     }

     public function  show($id){
        return $this->recept->show($id);
     }

     public function update($id,Request $request){
        return $this->recept->update($id,$request);
     }

     public function destroy($id){
        return $this->recept->destroy($id);
     }
}
