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
        Schema::create('anggota', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->string('nama_depan');
            $table->string('nama_belakang')->nullable();
            $table->string('jenis_kelamin');
            $table->string('tanggal_lahir');
            $table->string('username');
            $table->string('email');
            $table->string('kota_lahir');
            $table->string('status');
            $table->char('foto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota');
    }
};
