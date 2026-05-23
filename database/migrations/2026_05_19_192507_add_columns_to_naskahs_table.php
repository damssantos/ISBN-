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
            $table->string('judul')->after('id');
            $table->string('sub_judul')->nullable()->after('judul');
            $table->text('sinopsis')->nullable()->after('sub_judul');
            $table->string('status')->default('Draf')->after('sinopsis');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('naskahs', function (Blueprint $table) {
            $table->dropColumn(['judul', 'sub_judul', 'sinopsis', 'status']);
        });
    }
};