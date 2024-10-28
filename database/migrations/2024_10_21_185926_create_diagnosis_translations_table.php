<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiagnosisTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnosis_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('diagnosis_id')->constrained('diagnoses')->onDelete('cascade')->onUpdate('cascade');
            $table->string('locale')->index();
            $table->longText('diagnoses_notes');
            $table->unique(['diagnosis_id', 'locale']);  // اسم الفهرس الفريد تم تعديله ليكون أقصر
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diagnosis_translations');
    }
}
