<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFundSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fund_schedules', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('single_invoice_id')->nullable()->constrained('single_invoices')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('invoice_id')->nullable()->constrained('invoices')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('receipt_id')->nullable()->constrained('receipts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('paiment_id')->nullable()->constrained('paiments')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('group_invoice_id')->nullable()->constrained('group__invoices')->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('debit',8,2)->nullable();
            $table->decimal('credit',8,2)->nullable();
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
        Schema::dropIfExists('fund_schedules');
    }
}
