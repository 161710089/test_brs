<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblHakAkses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('tbl_hak_akses');
        Schema::create('tbl_hak_akses', function (Blueprint $table) {
            $table->id();
            $table->integer('id_menu');
            $table->integer('id_level');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_hak_akses');
    }
}
