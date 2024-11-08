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
        Schema::table('subkompetensis', function (Blueprint $table) {
            $table->foreign(['kompetensi_id'])->references(['kompetensi_id'])->on('kompetensis')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subkompetensis', function (Blueprint $table) {
            $table->dropForeign('subkompetensis_kompetensi_id_foreign');
        });
    }
};
