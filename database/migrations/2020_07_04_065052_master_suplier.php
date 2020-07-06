<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MasterSuplier extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('master_suplier');
        Schema::create('master_suplier', function (Blueprint $table) {
            $table->id();
            $table->string('suplier');
            $table->string('kode_suplier')->unique();
            $table->text('alamat');
            $table->string('no_telepon');
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
        Schema::dropIfExists('master_suplier');
    }
}
