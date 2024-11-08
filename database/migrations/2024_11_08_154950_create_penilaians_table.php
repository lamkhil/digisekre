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
        Schema::create('penilaians', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('anggota_nik');
            $table->string('str_id');
            $table->string('dpc');
            $table->string('borang')->nullable();
            $table->string('dokumen')->nullable();
            $table->string('status');
            $table->string('verifikator_id')->nullable();
            $table->string('verifikator_name')->nullable();
            $table->dateTime('verifikator_date')->nullable();
            $table->string('pesan_verifikator')->nullable();
            $table->string('kontak')->nullable();
            $table->string('validator_id')->nullable();
            $table->string('validator_name')->nullable();
            $table->dateTime('validator_date')->nullable();
            $table->string('pesan_validator')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaians');
    }
};
