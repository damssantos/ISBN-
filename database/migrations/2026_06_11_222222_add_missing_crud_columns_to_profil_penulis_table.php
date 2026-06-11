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
            $table->string('email')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('nama_kantor')->nullable();
            $table->string('tempat_mengajar')->nullable();
            $table->string('file_ktp')->nullable();
            $table->string('foto_penulis')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profil_penulis', function (Blueprint $table) {
            $table->dropColumn(['email', 'no_hp', 'nama_kantor', 'tempat_mengajar', 'file_ktp', 'foto_penulis']);
        });
    }
};
