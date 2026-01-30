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
        Schema::create('qhs_inspect_r', function (Blueprint $table) {
            $table->string('no_dokumen', 20);
            $table->string('no_induk', 6);
            $table->primary(['no_dokumen', 'no_induk']);
            $table->foreign('no_dokumen')->references('no_dokumen')->on('qhs_inspect_h')->onDelete('cascade');
            $table->foreign('no_induk')->references('no_induk')->on('qhs_inspector')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qhs_inspect_r');
    }
};
