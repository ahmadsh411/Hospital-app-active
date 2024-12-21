<?php

namespace App\Models\Conversations;

use App\Models\Messages\Chat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;
    protected $fillable = ['sender_email','resiver_email','last_time_message'];

    public function messages(){
        return $this->hasMany(Chat::class,'conversation_id','id');
    }

    public static function getUserNameByEmail($email)
    {
        // البحث في جدول الإداريين
        $admin = \App\Models\Admin::where('email', $email)->first();
        if ($admin) {
            return  $admin->name;
        }

        // البحث في جدول الأطباء
        $doctor = \App\Models\Doctors\Doctor::where('email', $email)->first();
        if ($doctor) {
            return   $doctor->name;
        }

        // البحث في جدول الموظفين
        $staff = \App\Models\Staffs\Staff::where('email', $email)->first();
        if ($staff) {
            return  $staff->name;
        }

        // في حال لم يتم العثور على المستخدم في أي من الجداول
        return 'غير معروف';
    }

    public static function getUserNameByid($email)
    {
        // البحث في جدول الإداريين
        $admin = \App\Models\Admin::where('email', $email)->first();
        if ($admin) {
            return  $admin->id;
        }

        // البحث في جدول الأطباء
        $doctor = \App\Models\Doctors\Doctor::where('email', $email)->first();
        if ($doctor) {
            return  $doctor->id;
        }

        // البحث في جدول الموظفين
        $staff = \App\Models\Staffs\Staff::where('email', $email)->first();
        if ($staff) {
            return  $staff->id;
        }

        // في حال لم يتم العثور على المستخدم في أي من الجداول
        return 'غير معروف';
    }



}
