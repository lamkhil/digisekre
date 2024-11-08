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
        Schema::create('narasumbers', function (Blueprint $table) {
            $table->increments('narasumber_id');
            $table->string('nama');
            $table->string('nik', 16)->nullable()->unique();
            $table->string('email')->nullable()->unique();
            $table->string('wa')->nullable()->unique();
            $table->string('state');
            $table->string('is_active')->nullable()->default('Aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('narasumbers');
    }
};
