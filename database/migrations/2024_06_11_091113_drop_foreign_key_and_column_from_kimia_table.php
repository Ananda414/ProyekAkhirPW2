<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropForeignKeyAndColumnFromTimTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tim', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['anggota_id']);
            // Drop the column
            $table->dropColumn('anggota_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tim', function (Blueprint $table) {
            // Add the column back
            $table->unsignedBigInteger('anggota_id');
            // Add the foreign key constraint back
            $table->foreign('anggota_id')->references('id')->on('anggota')->onDelete('cascade');
        });
    }
}
