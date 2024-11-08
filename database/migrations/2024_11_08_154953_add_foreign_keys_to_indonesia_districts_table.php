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
        Schema::table('indonesia_districts', function (Blueprint $table) {
            $table->foreign(['city_id'])->references(['id'])->on('indonesia_cities')->onUpdate('cascade')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('indonesia_districts', function (Blueprint $table) {
            $table->dropForeign('indonesia_districts_city_id_foreign');
        });
    }
};
