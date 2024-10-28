<?php

namespace App\Interfaces\SingleInvoice;

interface spending_moneyInterface {

    public function  index();
    public function store($request);
    public function edit($id);
    public function update($id,$request);
    public function  destroy($id);
    public function show($id);
}
