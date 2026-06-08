<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Seed penulis user
        DB::table('akun_pengguna')->insert([
            'name' => 'Penulis User',
            'email' => 'penulis@gmail.com',
            'password' => Hash::make('penulis123'),
            'role' => 'penulis'
        ]);

        // Seed admin user
        DB::table('akun_pengguna')->insert([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);

        // Seed superadmin user
        DB::table('akun_pengguna')->insert([
            'name' => 'Superadmin User',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('superadmin123'),
            'role' => 'superadmin'
        ]);
    }

    public function test_login_page_renders_successfully()
    {
        $response = $this->get(route('login'));
        $response->assertStatus(200);
        $response->assertSee('ISBN YPIK PAM JAYA');
        $response->assertDontSee('Masuk Sebagai'); // Ensure role selector is gone
    }

    public function test_penulis_login_redirects_to_dashboard()
    {
        $response = $this->post(route('login.store'), [
            'email' => 'penulis@gmail.com',
            'password' => 'penulis123'
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertEquals('penulis', session('user_role'));
    }

    public function test_admin_login_redirects_to_admin_dashboard()
    {
        $response = $this->post(route('login.store'), [
            'email' => 'admin@gmail.com',
            'password' => 'admin123'
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertEquals('admin', session('user_role'));
    }

    public function test_superadmin_login_redirects_to_superadmin_dashboard()
    {
        $response = $this->post(route('login.store'), [
            'email' => 'superadmin@gmail.com',
            'password' => 'superadmin123'
        ]);

        $response->assertRedirect(route('superadmin.dashboard'));
        $this->assertEquals('superadmin', session('user_role'));
    }

    public function test_login_with_invalid_credentials_shows_error()
    {
        $response = $this->post(route('login.store'), [
            'email' => 'penulis@gmail.com',
            'password' => 'wrongpassword'
        ]);

        $response->assertRedirect();
        $response->assertSessionHasErrors('error');
    }
}
