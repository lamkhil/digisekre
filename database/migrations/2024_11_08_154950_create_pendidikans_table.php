<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pendidikans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('nik', 16);
            $table->string('nama_kampus', 100);
            $table->string('prodi', 50);
            $table->string('jenjang', 50);
            $table->string('gelar', 50);
            $table->string('no_ijazah', 50);
            $table->date('tanggal_ijazah');
            $table->text('scan_ijazah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendidikans');
    }
};
