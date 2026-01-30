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
        Schema::create('qhs_inspect_h', function (Blueprint $table) {
            $table->string('no_dokumen', 20)->primary();
            $table->date('tanggal');
            $table->string('jam_mulai', 5);
            $table->string('jam_selesai', 5)->nullable();
            $table->string('kode_dept', 2);
            $table->foreign('kode_dept')->references('kode_dept')->on('qhs_departemen')->onDelete('cascade');
            $table->string('kode_lokasi', 4)->nullable();
            $table->foreign('kode_lokasi')->references('kode_lokasi')->on('qhs_lokasi')->onDelete('set null');
            $table->string('user_input', 6);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qhs_inspect_h');
    }
};
