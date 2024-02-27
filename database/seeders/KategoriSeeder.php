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
        $data = [];
        for ($i = 0; $i < 5; $i++) {
            $data[] =
                [
                    "kategori_id" => $i + 1,
                    "kategori_kode" => "KATEGORI$i",
                    "kategori_nama" => "Kategori " . $i + 1,
                ];
        }
        DB::table('m_kategori')->insert($data);
    }
}
