<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                "stok_id" => $i + 1,
                "barang_id" => rand(1, 10),
                "user_id" => rand(1, 3),
                "stok_tanggal" => Carbon::now(),
                "stok_jumlah" => $i + 1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ];
        }
        DB::table("t_stok")->insert($data);
    }
}
