<?php

use App\Models\SaleOrder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleOrderLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_order_lines', function (Blueprint $table) {
            $table->id();
            $table->string('sale_order_code', 20);
            $table->string('color_code', 20);
            $table->bigInteger('quantity');

            $table->foreign('sale_order_code')->references('code')->on('sale_orders')->cascadeOnDelete();
            $table->foreign('color_code')->references('code')->on('items')->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_order_lines');
    }
}
