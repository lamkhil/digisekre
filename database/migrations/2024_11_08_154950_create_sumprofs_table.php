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
        Schema::create('sumprofs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('nik', 16);
            $table->date('tanggal_sumprof');
            $table->text('scan_sumprof_1')->nullable();
            $table->text('scan_sumprof_2')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sumprofs');
    }
};
