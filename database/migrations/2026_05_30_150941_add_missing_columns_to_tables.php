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
        Schema::table('naskahs', function (Blueprint $table) {
            $table->string('foto_sampul')->nullable();
            $table->string('file_naskah')->nullable();
            $table->string('isbn')->nullable();
            $table->text('catatan_revisi')->nullable();
        });

        Schema::table('penulis', function (Blueprint $table) {
            $table->unsignedBigInteger('naskah_id')->nullable();
            $table->string('email')->nullable();
            $table->integer('urutan')->default(1);
            $table->text('biodata')->nullable();
        });

        Schema::table('akun_pengguna', function (Blueprint $table) {
            $table->string('no_hp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('naskahs', function (Blueprint $table) {
            $table->dropColumn(['foto_sampul', 'file_naskah', 'isbn', 'catatan_revisi']);
        });

        Schema::table('penulis', function (Blueprint $table) {
            $table->dropColumn(['naskah_id', 'email', 'urutan', 'biodata']);
        });

        Schema::table('akun_pengguna', function (Blueprint $table) {
            $table->dropColumn(['no_hp']);
        });
    }
};
