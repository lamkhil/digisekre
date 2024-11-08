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
        Schema::create('mutasis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_surat');
            $table->date('tanggal')->nullable();
            $table->string('bulan');
            $table->string('tahun');
            $table->string('pengajuan_id');
            $table->string('dpc')->nullable();
            $table->text('dokumen')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mutasis');
    }
};
