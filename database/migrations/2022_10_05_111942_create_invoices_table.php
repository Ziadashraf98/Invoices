<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('invoice_number')->unique();
            $table->date('invoice_date')->nullable();
            $table->date('due_date')->nullable();
            $table->foreignId('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('product');
            $table->decimal('collection_amount')->nullable();
            $table->decimal('commission_amount');
            $table->decimal('discount');
            $table->string('vat_rate');
            $table->decimal('vat_value');
            $table->decimal('total');
            $table->string('status');
            $table->tinyInteger('status_value');
            $table->text('note')->nullable();
            $table->date('payment_date')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('invoices');
    }
}
