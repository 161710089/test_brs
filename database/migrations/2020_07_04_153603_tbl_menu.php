<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::dropIfExists('tbl_menu');
      Schema::create('tbl_menu', function (Blueprint $table) {
          $table->id();
          $table->string('menu');
          $table->string('url');
          $table->string('icon');
          $table->enum('is_aktif', array('y','n'));
          $table->integer('is_main_menu');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('tbl_menu');
    }
}
