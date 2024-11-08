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
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('nik', 16);
            $table->string('nama', 100);
            $table->date('tanggal_lahir')->nullable();
            $table->string('pendidikan', 100)->nullable();
            $table->string('jenis', 50);
            $table->string('deskripsi', 100)->nullable();
            $table->string('no_str', 50)->nullable();
            $table->string('tempat_kerja', 100)->nullable();
            $table->string('kab_kota', 50)->nullable();
            $table->string('dpc', 50)->nullable();
            $table->string('kta', 50)->nullable();
            $table->string('almamater', 100)->nullable();
            $table->string('status', 50)->nullable();
            $table->string('pengaju', 50)->nullable();
            $table->text('pendukung')->nullable();
            $table->string('verifikator', 50)->nullable();
            $table->text('pesan')->nullable();
            $table->date('tanggal_verif')->nullable();
            $table->string('dpc_baru', 50)->nullable();
            $table->string('kab_kota_baru', 50)->nullable();
            $table->string('tempat_kerja_baru', 100)->nullable();
            $table->string('cpd', 15)->nullable();
            $table->string('sanksi', 15)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};
