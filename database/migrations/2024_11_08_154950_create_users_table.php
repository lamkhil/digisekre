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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('is_admin', 16)->nullable()->default('Anggota');
            $table->char('nik', 16)->nullable();
            $table->string('kab_kota')->nullable();
            $table->string('dpc')->nullable();
            $table->string('dpd')->nullable()->default('JABAR');
            $table->string('wa', 20)->nullable();
            $table->string('mutasi', 50)->nullable();
            $table->string('verif', 50)->nullable();
            $table->string('instansi_id')->nullable();
            $table->string('role_id')->nullable();
            $table->string('is_active')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
