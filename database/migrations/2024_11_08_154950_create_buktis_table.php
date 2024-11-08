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
        Schema::create('buktis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama', 50)->nullable();
            $table->string('anggota_nik', 20)->nullable();
            $table->integer('nominal')->nullable();
            $table->string('tahun', 20)->nullable();
            $table->string('sumber', 20)->nullable();
            $table->string('operator', 50)->nullable();
            $table->text('keterangan')->nullable();
            $table->text('pesan')->nullable();
            $table->text('dokumen')->nullable();
            $table->string('dpc', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buktis');
    }
};
