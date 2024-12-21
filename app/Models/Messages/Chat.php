<?php

namespace App\Models\Messages;

use App\Models\Conversations\Conversation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    protected $table='messages';

    protected $fillable=['conversation_id','sender_email','resiver_email','read','body','type'];


    public function  conversation(){
        return $this->belongsTo(Conversation::class,'conversation_id','id');
    }
}
