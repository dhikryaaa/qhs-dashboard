<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['id', 'name', 'email', 'email_verified_at', 'remember_token', 'created_at', 'updated_at']);

            $table->string('no_induk', 6)->primary();
            $table->string('nama', 50);
            $table->string('aktif', 1);
            $table->string('kode_role', 2)->nullable();
            $table->string('kode_dept', 2)->nullable();
            $table->foreign('kode_role')->references('kode_role')->on('qhs_role')->onDelete('set null');
            $table->foreign('kode_dept')->references('kode_dept')->on('qhs_departemen')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['no_induk', 'nama', 'aktif', 'kode_role', 'kode_dept']);

            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }
};
