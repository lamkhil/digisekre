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
        Schema::table('acaras', function (Blueprint $table) {
            $table->foreign(['borang_id'])->references(['borang_id'])->on('borangs')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['instansi_id'])->references(['instansi_id'])->on('instansis')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['subkompetensi_id'])->references(['subkompetensi_id'])->on('subkompetensis')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('acaras', function (Blueprint $table) {
            $table->dropForeign('acaras_borang_id_foreign');
            $table->dropForeign('acaras_instansi_id_foreign');
            $table->dropForeign('acaras_subkompetensi_id_foreign');
        });
    }
};
