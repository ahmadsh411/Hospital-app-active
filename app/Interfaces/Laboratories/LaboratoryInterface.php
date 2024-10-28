<?php

namespace  App\Interfaces\Laboratories;

interface LaboratoryInterface
{
    public function store($request);

    public function edit($id);

    public function update($request, $id);

    public function delete($id);
}
