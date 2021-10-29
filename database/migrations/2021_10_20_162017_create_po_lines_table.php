<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('po_lines', function (Blueprint $table) {
            $table->id();
            $table->string('po_code', 20);
            $table->string('color_code', 20);
            $table->bigInteger('quantity');
            $table->float('price_per_unit');

            $table->foreign('po_code')->references('code')->on('pos')->cascadeOnDelete();
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
        Schema::dropIfExists('po_lines');
    }
}
