<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SubKriteriaMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_kriteria', function (Blueprint $table) {
            $table->id();
            $table->string('cat_kriteria');
            // $table->string('id_penyakit');
            $table->foreign('cat_kriteria')->references('kode_kriteria')->on('kriteria')->onDelete('cascade');
            $table->integer('nilai');
            $table->string('range');
            $table->string('kategori');
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
