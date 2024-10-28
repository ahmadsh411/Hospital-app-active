<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsuranceTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurance_translations', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->longText('notes');
            $table->foreignId('insurance_id')->constrained('insurances')->onDelete('cascade')->onUpdate('cascade');
            $table->string('locale')->index();
            $table->unique(['company_name','notes','insurance_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_insurance_translations');
    }
}
