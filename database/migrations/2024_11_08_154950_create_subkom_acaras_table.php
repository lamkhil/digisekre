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
        Schema::create('subkom_acaras', function (Blueprint $table) {
            $table->increments('subkom_acara_id');
            $table->integer('subkompetensi_id');
            $table->string('instansi_id', 50);
            $table->integer('acara_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subkom_acaras');
    }
};
