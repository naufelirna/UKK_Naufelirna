<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Industri;

class IndustriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $industris = Industri::insert([
            [
                'nama' => 'PT Aksa Digital Group', 
                'bidang_usaha' => 'IT Service and IT Consulting (Information Technology Company)',
                'alamat' => 'Jl. Wongso Permono No.26, Klidon, Sukoharjo, Kec. Ngaglik, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55581',
                'kontak' => '08982909000',
                'email' => 'aksa@gmail.com',
                'web' => 'https://aksa.id/',
            ],
            [
                'nama' => 'PT Cyberkarta', 
                'bidang_usaha' => 'IT Service and IT Consulting',
                'alamat' => 'Jl. Pogung Kidul No.17, Pogung Kidul, Sinduadi, Kec. Mlati, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55284',
                'kontak' => '085161835865',
                'email' => 'cyberkarta@gmail.com',
                'web' => 'https://www.cyberkarta.com',
            ],
            [
                'nama' => 'PT Cyber Olympus', 
                'bidang_usaha' => 'Software Development',
                'alamat' => 'Jl. Padma No.22, Panggung Sari, Sariharjo, Kec. Ngaglik, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55581',
                'kontak' => '08783869717',
                'email' => 'info@cyberolympus.com',
                'web' => 'http://cyberolympus.com',
            ],
        ]);
    }
}
