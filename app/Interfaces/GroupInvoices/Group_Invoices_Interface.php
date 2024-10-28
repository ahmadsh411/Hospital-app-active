<?php

namespace App\Interfaces\GroupInvoices;

interface Group_Invoices_Interface{

    public function index();

    public function store($request);

    public function edit($id);

    public function update($id,$request);

    public function destroy($id);

    public function show($id);
}

