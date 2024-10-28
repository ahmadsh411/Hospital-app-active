<?php

namespace App\Interfaces\SingleInvoice;

interface  Single_Invoice_Interface {

    public function index();

    public function store($request);

    public function update($id,$request);

    public function edit($id);

    public function destroy($id);
    
    public function show($id);
}
