<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Siswa;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $siswa = Siswa::insert([
            [
                'nama' => 'MUTIARA SEKAR KINASIH',
                'nis'=> '20431',
                'gender' => 'P',
                'alamat' => 'Kasihan, Bantul',
                'kontak' => '08112657217',
                'email' => 'mtiaraskinasih@gmail.com',
                'status_pkl' => 'belum',
            ],
            [
                'nama' => 'NABILA NUR AZIZAH',
                'nis'=> '20432',
                'gender' => 'P',
                'alamat' => 'Cangkringan, Sleman',
                'kontak' => '081321817238',
                'email' => 'nabilanura@gmail.com',
                'status_pkl' => 'belum',
            ],
            [
                'nama' => 'MUHAMMAD AKBAR AMAANULLAAH',
                'nis'=> '20426',
                'gender' => 'L',
                'alamat' => 'Serang, Banten',
                'kontak' => '085198542434',
                'email' => 'muhammadakbaramaanullaah@gmail.com',
                'status_pkl' => 'belum',
            ],
            [
                'nama' => 'NAUFELIRNA SUBKHI RAMADHANI',
                'nis'=> '20434',
                'gender' => 'P',
                'alamat' => 'Ngemplak, Sleman',
                'kontak' => '089671421234',
                'email' => 'adzanaufel705@gmail.com',
                'status_pkl' => 'belum',
            ],
            [
                'nama' => 'THARA BUNGA NOVRIYANSYAH',
                'nis'=> '20454',
                'gender' => 'P',
                'alamat' => 'Kasihan, Bantul',
                'kontak' => '087834060198',
                'email' => 'tharabnv@gmail.com',
                'status_pkl' => 'belum',
            ],
            [
                'nama' => 'KAYSA AQILA AMTA',
                'nis'=> '20419',
                'gender' => 'P',
                'alamat' => 'Turi, Sleman',
                'kontak' => '085839328605',
                'email' => 'aqil@gmail.com',
                'status_pkl' => 'belum',
            ],
            [
                'nama' => 'ADE ZAIDAN ALTHAF',
                'nis'=> '20390',
                'gender' => 'L',
                'alamat' => 'Sleman',
                'kontak' => '085839328607',
                'email' => 'ade@gmail.com',
                'status_pkl' => 'belum',
            ],
        ]);
    }
}
