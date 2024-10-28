<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenderTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gender_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();
            $table->string('gender_name');
            $table->foreignId('gender_id')->constrained('genders')->onDelete('cascade');
            $table->unique(['locale','gender_name']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gender_translations');
    }
}
