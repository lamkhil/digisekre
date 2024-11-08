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
        Schema::create('borangs', function (Blueprint $table) {
            $table->increments('borang_id');
            $table->unsignedInteger('ranah_id')->index('borangs_ranah_id_foreign');
            $table->string('nama_borang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borangs');
    }
};
