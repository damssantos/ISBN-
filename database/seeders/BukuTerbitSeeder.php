<?php

namespace Database\Seeders;

use App\Models\BukuTerbit;
use Illuminate\Database\Seeder;

class BukuTerbitSeeder extends Seeder
{
    public function run(): void
    {
        $bukus = [
            [
                'judul' => 'Arsitektur Digital Masa Depan',
                'penulis' => 'Dr. Ahmad Subarjo',
                'isbn' => '978-602-433-123-4',
                'tanggal_terbit' => '2023-10-12',
                'cover_url' => 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?w=400&fit=crop&q=80',
                'kategori' => 'Teknologi & Konstruksi',
                'penerbit' => 'YPIK PAM JAYA Press',
                'jumlah_halaman' => 256,
                'sinopsis' => 'Buku ini membahas perkembangan teknologi arsitektur digital terkini dan bagaimana ia merevolusi cara manusia mendesain serta membangun lingkungan sekitar. Mulai dari pemodelan parametrik, simulasi lingkungan berbasis komputasi, hingga integrasi kecerdasan buatan dalam merancang kota pintar (smart city) masa depan yang berkelanjutan.',
            ],
            [
                'judul' => 'Logika Pemrograman Lanjut',
                'penulis' => 'Siti Aminah, M.Kom',
                'isbn' => '978-623-111-567-8',
                'tanggal_terbit' => '2023-10-10',
                'cover_url' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=400&fit=crop&q=80',
                'kategori' => 'Komputer & IT',
                'penerbit' => 'YPIK PAM JAYA Press',
                'jumlah_halaman' => 312,
                'sinopsis' => 'Ditujukan untuk para mahasiswa teknik informatika dan programmer profesional, buku ini mengupas tuntas algoritma tingkat lanjut, struktur data kompleks, serta paradigma pemrograman modern. Dilengkapi studi kasus industri nyata untuk mempercepat pemahaman dalam memecahkan masalah komputasional berskala besar.',
            ],
            [
                'judul' => 'Seni Menulis Kreatif',
                'penulis' => 'Budi Darmawan',
                'isbn' => '978-602-000-888-0',
                'tanggal_terbit' => '2023-10-08',
                'cover_url' => 'https://images.unsplash.com/photo-1455390582262-044cdead277a?w=400&fit=crop&q=80',
                'kategori' => 'Bahasa & Sastra',
                'penerbit' => 'YPIK PAM JAYA Press',
                'jumlah_halaman' => 198,
                'sinopsis' => 'Sebuah panduan komprehensif bagi siapa saja yang ingin mengasah keterampilan bercerita dan menulis fiksi maupun non-fiksi secara kreatif. Buku ini mengulik rahasia pembangunan karakter yang kuat, penyusunan plot dramatis yang memikat pembaca, hingga teknik swasunting sebelum mengirimkan karya ke penerbit nasional.',
            ],
        ];

        foreach ($bukus as $buku) {
            BukuTerbit::updateOrCreate(['isbn' => $buku['isbn']], $buku);
        }
    }
}
