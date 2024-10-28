<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_id')->constrained('staff')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('appointment_id')->constrained('appointments')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff_appointments');
    }
}
