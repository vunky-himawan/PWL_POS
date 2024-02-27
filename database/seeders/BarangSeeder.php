<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        for ($i = 0; $i < 10; $i++) {
            $data[] =
                [
                    "barang_id" => $i + 1,
                    "kategori_id" => rand(1, 3),
                    "barang_kode" => "BARANG$i",
                    "barang_nama" => "Barang " . $i + 1,
                    "harga_beli" => 100000 * ($i + 1),
                    "harga_jual" => 110000 * ($i + 1),
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ];
        }
        DB::table('m_barang')->insert($data);
    }
}
