<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rays', function (Blueprint $table) {
            $table->id();
            $table->longText('description')->nullable();
            $table->foreignId('invoice_id')->constrained('invoices')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('status')->default(0);
            $table->foreignId('staff_id')->nullable()->constrained('staff')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->string('staff_description')->nullable();
            $table->string('staff_name')->nullable();
            $table->date('staff_date')->nullable();


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
        Schema::dropIfExists('rays');
    }
}
