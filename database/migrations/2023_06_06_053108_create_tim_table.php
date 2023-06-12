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
        Schema::create('tim', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->string('nama_tim');
            $table->string('deskripsi_tim');
            $table->string('tanggal_berdiri');
            $table->string('anggota_id');
            $table->foreign('anggota_id')->references('id')->on('anggota')->cascadeOnDelete()->cascadeOnDelete();
            $table->char('logo');
            $table->string('kontak');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tim');
    }
};
