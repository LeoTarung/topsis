<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlternativeMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('db_alternatif', function (Blueprint $table) {
            // $table->id();
            $table->string('kode_alternatif')->primary();
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
