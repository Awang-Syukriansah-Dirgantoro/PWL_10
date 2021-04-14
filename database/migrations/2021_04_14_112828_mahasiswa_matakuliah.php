<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MahasiswaMatakuliah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswa_matakuliah', function (Blueprint $table) {
            $table->id();
            $table->string('Mahasiswa_Nim', 20)->nullable();
            $table->unsignedBigInteger('MataKuliah_id')->nullable();
            $table->foreign('Mahasiswa_Nim')->references('Nim')->on('mahasiswas');
            $table->foreign('MataKuliah_id')->references('id')->on('matakuliah');
            $table->string('Nilai');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mahasiswa_matakuliah');
    }
}
