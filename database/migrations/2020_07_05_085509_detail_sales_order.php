<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DetailSalesOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('detail_sales_order');
        Schema::create('detail_sales_order', function (Blueprint $table) {
            $table->id();
            $table->integer('id_produk');
            $table->double('harga');
            $table->integer('kuantitas');
            $table->integer('id_sales_order');
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
        Schema::dropIfExists('detail_sales_order');
    }
}
