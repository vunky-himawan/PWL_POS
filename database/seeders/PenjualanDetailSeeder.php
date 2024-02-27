<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        for ($i = 0; $i < 30; $i++) {
            $data[] = [
                "detail_id" => $i + 1,
                "penjualan_id" => rand(1, 10),
                "barang_id" => rand(1, 10),
                "harga" => 200000 * $i,
                "jumlah" => $i + 1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ];
        }
        DB::table("t_penjualan_detail")->insert($data);
    }
}
