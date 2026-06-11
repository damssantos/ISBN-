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
        Schema::table('profil_penulis', function (Blueprint $table) {
            $table->string('nama_ktp')->nullable();
            $table->string('no_telepon')->nullable();
            $table->text('alamat_surat')->nullable();
            $table->string('npwp')->nullable();
            $table->string('nama_npwp')->nullable();
            $table->text('alamat_npwp')->nullable();
            $table->string('no_rekening')->nullable();
            $table->string('nama_rekening')->nullable();
            $table->string('nama_bank')->nullable();
            $table->string('cabang_bank')->nullable();
            $table->string('kota_bank')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profil_penulis', function (Blueprint $table) {
            $table->dropColumn([
                'nama_ktp',
                'no_telepon',
                'alamat_surat',
                'npwp',
                'nama_npwp',
                'alamat_npwp',
                'no_rekening',
                'nama_rekening',
                'nama_bank',
                'cabang_bank',
                'kota_bank'
            ]);
        });
    }
};
