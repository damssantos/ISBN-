<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Naskah;
use Illuminate\Support\Facades\DB;

class AdminTest extends TestCase
{
    // Do not use RefreshDatabase if you want to keep the seeded sqlite data,
    // but in tests we typically want to isolate the test database or run transactions.
    // Let's use database transactions so it rolls back changes:
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Add some dummy data for tests
        DB::table('akun_pengguna')->insert([
            'name' => 'Pradama Test',
            'email' => 'pradama.test@example.com',
            'password' => 'password',
            'no_hp' => '081234567890'
        ]);

        $naskah = Naskah::create([
            'judul' => 'Test Judul',
            'sub_judul' => 'Test Sub',
            'sinopsis' => 'Test Sinopsis',
            'status' => 'Dalam Peninjauan'
        ]);

        $naskah->penuliss()->create([
            'nama' => 'Penulis Test',
            'email' => 'penulis.test@example.com',
            'urutan' => 1,
            'biodata' => 'Biodata Test'
        ]);
    }

    public function test_admin_dashboard_renders()
    {
        $response = $this->get(route('admin.dashboard'));
        $response->assertStatus(200);
        $response->assertSee('Test Judul');
        $response->assertSee('Pradama Test');
    }

    public function test_admin_review_naskah_renders()
    {
        $response = $this->get(route('admin.review-naskah'));
        $response->assertStatus(200);
        $response->assertSee('Test Judul');
    }

    public function test_admin_detail_review_naskah_renders()
    {
        $naskah = Naskah::first();
        $response = $this->get(route('admin.detail-review-naskah', $naskah->id));
        $response->assertStatus(200);
        $response->assertSee($naskah->judul);
        $response->assertSee('Penulis Test');
    }

    public function test_admin_update_status_setujui()
    {
        $naskah = Naskah::first();
        $response = $this->post(route('admin.update-status', $naskah->id), [
            'action' => 'setujui'
        ]);

        $response->assertRedirect(route('admin.review-naskah'));
        
        $naskah->refresh();
        $this->assertEquals('Disetujui', $naskah->status);
        $this->assertNotNull($naskah->isbn);
    }

    public function test_admin_update_status_revisi()
    {
        $naskah = Naskah::first();
        $response = $this->post(route('admin.update-status', $naskah->id), [
            'action' => 'revisi',
            'catatan_revisi' => 'Perlu revisi pada bab 1.'
        ]);

        $response->assertRedirect(route('admin.review-naskah'));
        
        $naskah->refresh();
        $this->assertEquals('Revisi', $naskah->status);
        $this->assertEquals('Perlu revisi pada bab 1.', $naskah->catatan_revisi);
    }

    public function test_admin_buku_terbit_renders()
    {
        // Approve first to make it show in buku terbit
        $naskah = Naskah::first();
        $naskah->status = 'Disetujui';
        $naskah->isbn = '978-623-1234-567-8';
        $naskah->save();

        $response = $this->get(route('admin.buku-terbit'));
        $response->assertStatus(200);
        $response->assertSee('Test Judul');
        $response->assertSee('978-623-1234-567-8');
    }

    public function test_admin_pengguna_renders()
    {
        $response = $this->get(route('admin.pengguna'));
        $response->assertStatus(200);
        $response->assertSee('Pradama Test');
    }

    public function test_writer_profile_renders_and_saves()
    {
        $user = DB::table('akun_pengguna')->where('email', 'pradama.test@example.com')->first();

        // 1. Check profile page renders and auto-creates profil_penulis
        $response = $this->withSession(['user_id' => $user->id, 'user_name' => $user->name])
            ->get(route('profil.informasi'));

        $response->assertStatus(200);
        $response->assertSee($user->name);

        // Verify row created in DB
        $profile = DB::table('profil_penulis')->where('user_id', $user->id)->first();
        $this->assertNotNull($profile);

        // 2. Submit update request
        $updateResponse = $this->withSession(['user_id' => $user->id, 'user_name' => $user->name])
            ->post(route('profil.update'), [
                'name' => 'Pradama Updated Name',
                'no_hp' => '089999999999',
                'gelar_depan' => 'Dr.',
                'gelar_belakang' => 'M.T.',
                'jenis_kelamin' => 'Laki-laki',
                'agama' => 'Islam',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1990-01-01',
                'nik' => '1234567890123456',
                'alamat_ktp' => 'Jl. Test No. 123'
            ]);

        $updateResponse->assertRedirect();
        
        // Verify changes synced in akun_pengguna
        $updatedUser = DB::table('akun_pengguna')->where('id', $user->id)->first();
        $this->assertEquals('Pradama Updated Name', $updatedUser->name);
        $this->assertEquals('089999999999', $updatedUser->no_hp);

        // Verify changes saved in profil_penulis
        $updatedProfile = DB::table('profil_penulis')->where('user_id', $user->id)->first();
        $this->assertEquals('Dr.', $updatedProfile->gelar_depan);
        $this->assertEquals('Pradama Updated Name', $updatedProfile->name);
        $this->assertEquals('1234567890123456', $updatedProfile->nik);
    }
}
