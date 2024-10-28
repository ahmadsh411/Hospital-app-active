<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group__invoices', function (Blueprint $table) {
            $table->id();
            $table->date('invoice_date');
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('section_id')->constrained('sections')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('group_id')->constrained('multi_services')->onDelete('cascade')->onUpdate('cascade');
            $table->double('price',8,2)->default(0);
            $table->double('discount_value',8,2)->default(0);
            $table->string('tax_rate');
            $table->string('tax_value');
            $table->double('tot_with_tax',8,2)->default(0);
            $table->integer('type')->default(1);
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
        Schema::dropIfExists('group__invoices');
    }
}