<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMultiServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multi_services', function (Blueprint $table) {
            $table->id();
            $table->decimal('total_before_discount',8,2);//1000
            $table->decimal('discount_value',8,2);//300
            $table->decimal('total_after_discount',8,2);//700
            $table->string('tax_rate');//15%*700
            $table->decimal('total_with_tax',8,2);//15%*700 +700
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
        Schema::dropIfExists('multi_services');
    }
}
