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
        Schema::create('pekerjaans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('nik', 16);
            $table->string('jenis_instansi', 50);
            $table->string('nama_instansi', 50);
            $table->string('provinsi', 50);
            $table->string('kab_kota', 50);
            $table->date('awal_kerja');
            $table->string('status', 50);
            $table->string('jabatan', 50)->nullable();
            $table->string('domain', 10)->nullable();
            $table->string('dpc', 50)->nullable();
            $table->string('nip', 50)->nullable();
            $table->string('pangkat', 50)->nullable();
            $table->string('jabatan_fungsional', 50)->nullable();
            $table->string('no_sk_jabfung', 50)->nullable();
            $table->date('tmt_jabfung')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pekerjaans');
    }
};
