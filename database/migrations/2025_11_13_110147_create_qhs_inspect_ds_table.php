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
        Schema::create('qhs_inspect_d', function (Blueprint $table) {
            $table->string('no_dokumen', 20);
            $table->foreign('no_dokumen')->references('no_dokumen')->on('qhs_inspect_h')->onDelete('cascade');
            $table->integer('sub');
            $table->primary(['no_dokumen', 'sub']);
            $table->string('kode', 3)->nullable();
            $table->foreign('kode')->references('kode')->on('qhs_kategori')->onDelete('set null');
            $table->char('bukti_temuan', 20);
            $table->string('deskripsi', 500);
            $table->string('dokumen', 100)->nullable();
            $table->string('referensi', 100)->nullable();
            $table->string('saran_koreksi', 500)->nullable();
            $table->string('saran_korektif', 500)->nullable();
            $table->string('status', 10)->nullable();
            $table->date('tgl_perbaikan')->nullable();
            $table->char('bukti_perbaikan', 20)->nullable();
            $table->date('tgl_close')->nullable();
            $table->string('user_close', 6)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qhs_inspect_d');
    }
};
