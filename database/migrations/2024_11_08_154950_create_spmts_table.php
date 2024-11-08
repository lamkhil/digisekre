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
        Schema::create('spmts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('anggota_nik');
            $table->string('pekerjaan_id')->nullable();
            $table->string('scan_spmt');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spmts');
    }
};
