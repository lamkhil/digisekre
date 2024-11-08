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
        Schema::create('wilayah_kabupaten', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('provinsi_id', 2)->default('');
            $table->string('nama', 30);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wilayah_kabupaten');
    }
};
