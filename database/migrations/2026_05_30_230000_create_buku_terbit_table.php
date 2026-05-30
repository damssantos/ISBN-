<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('buku_terbit', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('penulis');
            $table->string('isbn')->unique();
            $table->date('tanggal_terbit');
            $table->string('cover_url');
            $table->string('kategori');
            $table->string('penerbit')->default('YPIK PAM JAYA Press');
            $table->unsignedInteger('jumlah_halaman')->default(0);
            $table->text('sinopsis');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('buku_terbit');
    }
};
