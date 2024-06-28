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
        Schema::create('proyek', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->string('nama_proyek');
            $table->string('deskripsi_proyek')->nullable();
            $table->string('deadline');
            $table->string('budget')->nullable();
            $table->uuid('tim_id');
            $table->foreign('tim_id')->references('id')->on('tim');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyek');
    }
};
