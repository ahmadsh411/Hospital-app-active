<?php

 namespace App\Interfaces\Conversations\AdminConversation;


 interface AdminConversationInterface{

    public function index();

    public function show($email);

    public function store($request,$id);

     public function lastconversation();
     public function showAjax($email);
 }
