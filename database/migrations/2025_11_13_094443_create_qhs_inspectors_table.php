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
        Schema::create('qhs_inspector', function (Blueprint $table) {
            $table->string('no_induk', 6)->primary();
            $table->string('nama', 50);
            $table->string('aktif', 1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qhs_inspector');
    }
};
