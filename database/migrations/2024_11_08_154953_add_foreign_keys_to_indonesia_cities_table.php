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
        Schema::table('indonesia_cities', function (Blueprint $table) {
            $table->foreign(['province_id'])->references(['id'])->on('indonesia_provinces')->onUpdate('cascade')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('indonesia_cities', function (Blueprint $table) {
            $table->dropForeign('indonesia_cities_province_id_foreign');
        });
    }
};
