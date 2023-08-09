<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PenilaianMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kriteria');
            $table->foreign('kode_kriteria')->references('kode_kriteria')->on('kriteria')->onDelete('cascade');

            // $table->unsignedBigInteger('sub_kriteria');
            // $table->foreign('sub_kriteria')->references('id')->on('sub_kriteria')->onDelete('cascade');

            $table->string('kode_alternatif');
            $table->foreign('kode_alternatif')->references('kode_alternatif')->on('alternatif')->onDelete('cascade');
            $table->integer('nilai');
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
