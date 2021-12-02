<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PinjamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pinjam', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('id_user');
            $table->smallInteger('id_buku');
            $table->timestamp('tanggal_pinjam')->useCurrent();;
            $table->timestamp('tanggal_kembali')->useCurrent();;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_pinjam');
    }
}
