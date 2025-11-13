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
        Schema::create('qhs_lokasi', function (Blueprint $table) {
            $table->string('kode_lokasi', 4)->primary();
            $table->string('nama_lokasi', 50);
            $table->string('aktif', 1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qhs_lokasi');
    }
};
