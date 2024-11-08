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
        Schema::create('anggotas', function (Blueprint $table) {
            $table->char('nik', 16)->primary();
            $table->string('nama', 50);
            $table->string('tempat_lahir', 50);
            $table->date('tanggal_lahir');
            $table->string('jk', 15);
            $table->string('agama', 20);
            $table->char('gd', 2);
            $table->string('status', 30);
            $table->string('pekerjaan', 50);
            $table->text('alamat');
            $table->string('rt', 10);
            $table->string('rw', 10);
            $table->string('desa_kel', 50);
            $table->string('kec', 50);
            $table->string('kab', 50);
            $table->string('provinsi', 50);
            $table->text('ktp')->nullable();
            $table->text('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggotas');
    }
};
