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
        Schema::create('sukets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_surat', 50)->nullable();
            $table->date('tanggal');
            $table->string('bulan', 50);
            $table->string('tahun', 100);
            $table->string('pengajuan_id', 50);
            $table->string('dpc', 50)->nullable();
            $table->text('dokumen')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sukets');
    }
};
