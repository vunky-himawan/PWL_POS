<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                "penjualan_id" => $i + 1,
                "user_id" => rand(1, 3),
                "pembeli" => "Pembeli " . $i + 1,
                "penjualan_kode" => "KODE" . $i + 1,
                "penjualan_tanggal" => Carbon::now(),
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ];
        }
        DB::table("t_penjualan")->insert($data);
    }
}
