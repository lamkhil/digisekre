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
        Schema::create('acaras', function (Blueprint $table) {
            $table->increments('acara_id');
            $table->unsignedInteger('subkompetensi_id')->nullable()->index('acaras_subkompetensi_id_foreign');
            $table->unsignedInteger('borang_id')->nullable()->index('acaras_borang_id_foreign');
            $table->unsignedInteger('instansi_id')->index('acaras_instansi_id_foreign');
            $table->string('nama_acara');
            $table->string('jenis');
            $table->string('metode', 50);
            $table->string('tempat');
            $table->string('periode')->nullable();
            $table->date('awal');
            $table->date('akhir');
            $table->string('proposal')->nullable();
            $table->string('flyer')->nullable();
            $table->string('bukti_bayar')->nullable();
            $table->string('status', 50)->nullable();
            $table->string('status_new', 50)->nullable();
            $table->string('petugas')->nullable();
            $table->string('pesan')->nullable();
            $table->string('publish', 50)->nullable();
            $table->string('register', 50)->nullable();
            $table->string('link_daftar')->nullable();
            $table->string('skp')->nullable();
            $table->string('scan_skp')->nullable();
            $table->string('upload')->nullable();
            $table->string('generate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acaras');
    }
};
