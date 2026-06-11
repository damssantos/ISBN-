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
            $table->boolean('is_self')->default(false);
        });
        
        // Update existing records to have is_self = true (if they represent the user's own profile)
        // Since id=1 is the default insert, let's make it is_self = true
        Illuminate\Support\Facades\DB::table('profil_penulis')->where('id', 1)->update(['is_self' => true]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profil_penulis', function (Blueprint $table) {
            $table->dropColumn('is_self');
        });
    }
};
