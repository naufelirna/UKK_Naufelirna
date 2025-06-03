<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Siswa;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pkls')->delete(); // hapus data anak dulu
DB::table('siswas')->delete(); // baru hapus data utama

        $siswa = Siswa::insert([
            [
                'nama' => 'MUTIARA SEKAR KINASIH',
                'nis'=> '20436',
                'gender' => 'P',
                'alamat' => 'Kasihan, Bantul',
                'kontak' => '08112657217',
                'email' => 'mtiaraskinasih@gmail.com',
                'status_pkl' => 'false',
            ],
            [
                'nama' => 'NABILA NUR AZIZAH',
                'nis'=> '20432',
                'gender' => 'P',
                'alamat' => 'Cangkringan, Sleman',
                'kontak' => '081321817238',
                'email' => 'nabilanura@gmail.com',
                'status_pkl' => 'false',
            ],
            [
                'nama' => 'MUHAMMAD AKBAR AMAANULLAAH',
                'nis'=> '20426',
                'gender' => 'L',
                'alamat' => 'Serang, Banten',
                'kontak' => '085198542434',
                'email' => 'muhammadakbaramaanullaah@gmail.com',
                'status_pkl' => 'false',
            ],
            [
                'nama' => 'NAUFELIRNA SUBKHI RAMADHANI',
                'nis'=> '20434',
                'gender' => 'P',
                'alamat' => 'Ngemplak, Sleman',
                'kontak' => '089671421234',
                'email' => 'adzanaufel705@gmail.com',
                'status_pkl' => 'false',
            ],
            [
                'nama' => 'THARA BUNGA NOVRIYANSYAH',
                'nis'=> '20454',
                'gender' => 'P',
                'alamat' => 'Kasihan, Bantul',
                'kontak' => '087834060198',
                'email' => 'tharabnv@gmail.com',
                'status_pkl' => 'false',
            ],
            [
                'nama' => 'KAYSA AQILA AMTA',
                'nis'=> '20419',
                'gender' => 'P',
                'alamat' => 'Turi, Sleman',
                'kontak' => '085839328605',
                'email' => 'aqil@gmail.com',
                'status_pkl' => 'false',
            ],
            [
                'nama' => 'ADE ZAIDAN ALTHAF',
                'nis'=> '20390',
                'gender' => 'L',
                'alamat' => 'Sleman',
                'kontak' => '085839328607',
                'email' => 'ade@gmail.com',
                'status_pkl' => 'false',
            ],
            [
                'nama' => 'tes',
                'nis'=> '728929',
                'gender' => 'L',
                'alamat' => 'Sleman',
                'kontak' => '09865729276',
                'email' => 'siswa@gmail.com',
                'status_pkl' => 'true',
            ],
        ]);

         foreach ($siswas as $siswaData) {
            // Insert ke tabel siswas
            $siswa = Siswa::create($siswaData);

            // Buat user untuk login
            User::firstOrCreate(
                ['email' => $siswaData['email']],
                [
                    'name' => $siswaData['nama'],
                    'password' => bcrypt('password123'), // Password default
                    'role' => 'siswa',
                ]
            );
        }
    }
}
