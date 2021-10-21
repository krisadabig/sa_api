<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_orders', function (Blueprint $table) {
            $table->string('code', 20)->primary();
            $table->unsignedBigInteger('customer_id');
            $table->enum('status', ['WaitPay', 'Complete']);
            $table->float('total_price');
            $table->dateTime('complete_date')->nullable();
            $table->enum('paymentMethod', ['จ่ายเงินสด', 'จ่ายด้วยเช็ค']);
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_orders');
    }
}
