<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = [
            [
                "kategori_id" => 1,
                "kategori_kode" => "SPTT",
                "kategori_nama" => "Sepatu Tenis",
            ],
            [
                'kategori_id' => 2,
                'kategori_kode' => "SPTG",
                'kategori_nama' => "Sepatu Golf",
            ],
            [
                'kategori_id' => 3,
                'kategori_kode' => "SPTL",
                'kategori_nama' => "Sepatu Lari",
            ],
            [
                'kategori_id' => 4,
                'kategori_kode' => "SPTB",
                'kategori_nama' => "Sepatu Basket",
            ],
            [
                'kategori_id' => 5,
                'kategori_kode' => "SPTS",
                'kategori_nama' => "Sepatu Sepak Bola",
            ]
        ]
        ;
        DB::table('m_kategori')->insert($data);
    }
}
