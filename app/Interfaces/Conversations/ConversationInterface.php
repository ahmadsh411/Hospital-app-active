<?php

namespace  App\Interfaces\Conversations;


interface ConversationInterface{

    public  function  index();



    public  function  create();

    public function  store($request,$id);


    public function  update($id,$request);


    public function  destroy($id);


    public function show($email);


    public  function lastconversation();
}
