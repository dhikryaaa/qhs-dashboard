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
        Schema::create('qhs_counter', function (Blueprint $table) {
            $table->string('kode', 3);
            $table->string('bulan', 4);
            $table->integer('tahun');
            $table->integer('konter');
            $table->string('nomor', 20);

            $table->primary(['kode', 'bulan', 'tahun', 'konter']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qhs_counter');
    }
};
