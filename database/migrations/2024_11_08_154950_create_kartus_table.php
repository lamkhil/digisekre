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
        Schema::create('kartus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('nik', 16);
            $table->string('nomor', 20);
            $table->string('bulan', 2);
            $table->string('tahun', 4);
            $table->text('scan_kta');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kartus');
    }
};
