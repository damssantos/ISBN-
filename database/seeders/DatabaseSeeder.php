<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        if (!User::where('email', 'test@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
        }

        // Seed admin
        if (!DB::table('akun_pengguna')->where('email', 'admin@gmail.com')->exists()) {
            DB::table('akun_pengguna')->insert([
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]);
        }

        // Seed superadmin
        if (!DB::table('akun_pengguna')->where('email', 'superadmin@gmail.com')->exists()) {
            DB::table('akun_pengguna')->insert([
                'name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'password' => Hash::make('superadmin123'),
                'role' => 'superadmin',
            ]);
        }
    }
}
