<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PeminjamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('peminjaman', function (Blueprint $table) {
            $table->uuid('id_peminjaman')->primary();
            $table->uuid('id_siswa');
            $table->uuid('id_buku');
            $table->datetime('tgl_peminjaman');
            $table->datetime('tgl_pengembalian');
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
        Schema::dropIfExists('peminjaman');
    }
}
