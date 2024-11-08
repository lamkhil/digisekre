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
        Schema::table('indonesia_villages', function (Blueprint $table) {
            $table->foreign(['district_id'])->references(['id'])->on('indonesia_districts')->onUpdate('cascade')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('indonesia_villages', function (Blueprint $table) {
            $table->dropForeign('indonesia_villages_district_id_foreign');
        });
    }
};
