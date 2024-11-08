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
        Schema::create('kab_kotas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_kab');
            $table->string('nama_provinsi');
            $table->string('dpc')->nullable();
            $table->string('created_user')->nullable();
            $table->string('updated_user')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kab_kotas');
    }
};
