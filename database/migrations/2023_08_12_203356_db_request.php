<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DbRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('db_request', function (Blueprint $table) {
            // $table->id();
            $table->string('no_request')->primary();
            $table->integer('diskon');
            $table->integer('jumlah');
            $table->integer('total_harga');
            $table->integer('ppn');
            $table->integer('total_akhir');
            $table->string('kode_produk');
            $table->foreign('kode_produk')->references('kode_produk')->on('db_produk')->onDelete('cascade');
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
