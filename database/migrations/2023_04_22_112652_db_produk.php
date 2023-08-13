<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DbProduk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('db_produk', function (Blueprint $table) {
            // $table->id();
            $table->string('kode_produk')->primary();
            $table->string('nama_vendor');
            $table->integer('harga');
            // $table->decimal('bobot', $precision = 8, $scale = 2);
            $table->string('nama_produk');
            $table->string('alamat');
            $table->string('kota');
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
        //
    }
}
