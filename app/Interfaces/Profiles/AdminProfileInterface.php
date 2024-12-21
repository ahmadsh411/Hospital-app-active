<?php

namespace  App\Interfaces\Profiles;

interface AdminProfileInterface{

    public function show();

    public  function edit();

    public function update($request);
}
