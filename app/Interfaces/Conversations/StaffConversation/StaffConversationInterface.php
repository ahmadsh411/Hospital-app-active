<?php

namespace  App\Interfaces\Conversations\StaffConversation;


interface StaffConversationInterface{


    public function index();

    public function show($email);

    public function store($request,$id);

    public  function lastconversation();
}
