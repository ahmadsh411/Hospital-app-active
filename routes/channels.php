<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});



Broadcast::channel('invoices.{doctor_id}', function ($user, $doctor_id) {
    return $user->id == $doctor_id;
}, ['guards' => ['web', 'admin', 'doctor', 'staff']]);


Broadcast::channel('xrays.{doctor_id}', function ($user, $doctor_id) {
    return $user->id == $doctor_id;
}, ['guards' => ['web', 'admin', 'doctor', 'staff']]);

Broadcast::channel('laboratory.{doctor_id}', function ($user, $doctor_id) {
    return $user->id == $doctor_id;
}, ['guards' => ['web', 'admin', 'doctor', 'staff']]);


Broadcast::channel('sendXray.{section_id}', function ($user, $section_id) {
    return $user->section && $user->section->id == $section_id;
}, ['guards' => ['web', 'admin', 'doctor', 'staff']]);

Broadcast::channel('sendlaboratory.{section_id}', function ($user, $section_id) {
    return $user->section && $user->section->id == $section_id;
}, ['guards' => ['web', 'admin', 'doctor', 'staff']]);


Broadcast::channel('sndmessage.{email}', function ($user, $ids) {
    return $user->id == $ids;
}, ['guards' => ['web', 'admin', 'doctor', 'staff']]);


Broadcast::channel('doctor_message.{doctorId}', function ($user, $doctorId) {
    return $user->id === (int) $doctorId; // تأكد أن المستخدم هو نفس الدكتور
});


