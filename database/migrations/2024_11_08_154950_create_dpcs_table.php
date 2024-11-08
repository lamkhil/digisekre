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
        Schema::create('dpcs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_dpc');
            $table->string('ketua')->nullable();
            $table->string('alamat')->nullable();
            $table->string('hotline')->nullable();
            $table->string('email')->nullable();
            $table->string('akronim_1', 50)->nullable();
            $table->string('akronim_2', 50)->nullable();
            $table->string('tempat', 50)->nullable();
            $table->string('ttd', 50)->nullable();
            $table->string('kop', 50)->nullable();
            $table->string('akronim_3', 50)->nullable();
            $table->string('akronim_4', 50)->nullable();
            $table->string('akronim_5', 50)->nullable();
            $table->string('akronim_6', 50)->nullable();
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
        Schema::dropIfExists('dpcs');
    }
};
