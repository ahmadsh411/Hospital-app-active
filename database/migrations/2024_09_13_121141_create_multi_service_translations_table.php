<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMultiServiceTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multi_service_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();
            $table->string('name')->unique();
            $table->foreignId('multi_service_id')->constrained('multi_services')->onDelete('cascade')->onUpdate('cascade');
            $table->string('notes')->unique();
            $table->unique(['multi_service_id','locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('multi_service_translations');
    }
}
