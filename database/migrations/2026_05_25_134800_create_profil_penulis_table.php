<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profil_penulis', function (Blueprint $table) {
            $table->id();
            $table->string('gelar_depan')->nullable();
            $table->string('name');
            $table->string('gelar_belakang')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('agama')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('nik')->nullable();
            $table->text('alamat_ktp')->nullable();
            $table->timestamps();
        });

        // Insert default row so ProfilController->index() can find id=1
        DB::table('profil_penulis')->insert([
            'id'   => 1,
            'name' => 'Pradama',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_penulis');
    }
};
