<?php

namespace App\Interfaces\Invoices;

interface InvoiceInterface{

    public function index();

    public function create();
    public function store($request);

    public function edit($id);
    public function update($id,$request);

    public function destroy($id);
    
    public function show($id);
}
