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
        Schema::create('subkompetensis', function (Blueprint $table) {
            $table->increments('subkompetensi_id');
            $table->unsignedInteger('kompetensi_id')->index('subkompetensis_kompetensi_id_foreign');
            $table->string('nama_subkompetensi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subkompetensis');
    }
};
