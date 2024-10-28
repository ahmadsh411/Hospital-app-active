<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale');
            $table->string('name');
            $table->string('address');
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->unique(['locale','patient_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_translations');
    }
}
