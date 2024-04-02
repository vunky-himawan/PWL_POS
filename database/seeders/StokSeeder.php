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
        $data = [
            [
                "stok_id" => 1,
                "barang_id" => 1,
                "user_id" => 1,
                "stok_tanggal" => "2024-01-01 00:00:00",
                "stok_jumlah" => 30,
                "sisa" => 29,
                "created_at" => "2024-01-01 00:00:00",
                "updated_at" => "2024-01-01 00:00:00"
            ],
            [
                "stok_id" => 2,
                "barang_id" => 2,
                "user_id" => 1,
                "stok_tanggal" => "2024-02-02 00:00:00",
                "stok_jumlah" => 30,
                "sisa" => 29,
                "created_at" => "2024-02-02 00:00:00",
                "updated_at" => "2024-02-02 00:00:00"
            ],
            [
                "stok_id" => 3,
                "barang_id" => 3,
                "user_id" => 1,
                "stok_tanggal" => "2024-03-03 00:00:00",
                "stok_jumlah" => 30,
                "sisa" => 29,
                "created_at" => "2024-03-03 00:00:00",
                "updated_at" => "2024-03-03 00:00:00"
            ],
            [
                "stok_id" => 4,
                "barang_id" => 4,
                "user_id" => 1,
                "stok_tanggal" => "2024-04-04 00:00:00",
                "stok_jumlah" => 30,
                "sisa" => 29,
                "created_at" => "2024-04-04 00:00:00",
                "updated_at" => "2024-04-04 00:00:00"
            ],
            [
                "stok_id" => 5,
                "barang_id" => 5,
                "user_id" => 1,
                "stok_tanggal" => "2024-05-05 00:00:00",
                "stok_jumlah" => 30,
                "sisa" => 29,
                "created_at" => "2024-05-05 00:00:00",
                "updated_at" => "2024-05-05 00:00:00"
            ],
            [
                "stok_id" => 6,
                "barang_id" => 6,
                "user_id" => 1,
                "stok_tanggal" => "2024-06-06 00:00:00",
                "stok_jumlah" => 30,
                "sisa" => 29,
                "created_at" => "2024-06-06 00:00:00",
                "updated_at" => "2024-06-06 00:00:00"
            ],
            [
                "stok_id" => 7,
                "barang_id" => 7,
                "user_id" => 1,
                "stok_tanggal" => "2024-07-07 00:00:00",
                "stok_jumlah" => 30,
                "sisa" => 29,
                "created_at" => "2024-07-07 00:00:00",
                "updated_at" => "2024-07-07 00:00:00"
            ],
            [
                "stok_id" => 8,
                "barang_id" => 8,
                "user_id" => 1,
                "stok_tanggal" => "2024-08-08 00:00:00",
                "stok_jumlah" => 30,
                "sisa" => 29,
                "created_at" => "2024-08-08 00:00:00",
                "updated_at" => "2024-08-08 00:00:00"
            ],
            [
                "stok_id" => 9,
                "barang_id" => 9,
                "user_id" => 1,
                "stok_tanggal" => "2024-09-09 00:00:00",
                "stok_jumlah" => 30,
                "sisa" => 29,
                "created_at" => "2024-09-09 00:00:00",
                "updated_at" => "2024-09-09 00:00:00"
            ],
            [
                "stok_id" => 10,
                "barang_id" => 10,
                "user_id" => 1,
                "stok_tanggal" => "2024-10-10 00:00:00",
                "stok_jumlah" => 30,
                "sisa" => 29,
                "created_at" => "2024-10-10 00:00:00",
                "updated_at" => "2024-10-10 00:00:00"
            ],
            [
                "stok_id" => 11,
                "barang_id" => 11,
                "user_id" => 1,
                "stok_tanggal" => "2024-11-11 00:00:00",
                "stok_jumlah" => 30,
                "sisa" => 29,
                "created_at" => "2024-11-11 00:00:00",
                "updated_at" => "2024-11-11 00:00:00"
            ],
            [
                "stok_id" => 12,
                "barang_id" => 12,
                "user_id" => 1,
                "stok_tanggal" => "2024-12-12 00:00:00",
                "stok_jumlah" => 30,
                "sisa" => 29,
                "created_at" => "2024-12-12 00:00:00",
                "updated_at" => "2024-12-12 00:00:00"
            ],
        ];

        DB::table("t_stok")->insert($data);
    }
}
