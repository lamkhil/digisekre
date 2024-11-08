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
        Schema::table('borangs', function (Blueprint $table) {
            $table->foreign(['ranah_id'])->references(['ranah_id'])->on('ranahs')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('borangs', function (Blueprint $table) {
            $table->dropForeign('borangs_ranah_id_foreign');
        });
    }
};
