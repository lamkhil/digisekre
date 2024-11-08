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
        Schema::create('serkoms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('nik', 16);
            $table->string('no_serkom', 50);
            $table->date('tanggal_terbit');
            $table->text('scan_serkom')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('serkoms');
    }
};
