<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionTranslations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('locale')->index();
            // Foreign key to the main model
           $table->unsignedBigInteger('section_id');
           $table->longText('description');
           $table->unique(['section_id', 'locale']);
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');

       $table->string('name');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('section_translations');
    }
}
