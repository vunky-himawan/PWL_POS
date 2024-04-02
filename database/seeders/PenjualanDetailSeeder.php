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
        $data = [
            [
                "detail_id" => 1,
                "penjualan_id" => 1,
                "barang_id" => 1,
                "harga" => 10000000,
                "jumlah" => 1,
                "created_at" => "2024-01-01 00:00:00",
                "updated_at" => "2024-01-01 00:00:00"
            ],
            [
                "detail_id" => 2,
                "penjualan_id" => 2,
                "barang_id" => 2,
                "harga" => 3269000,
                "jumlah" => 1,
                "created_at" => "2024-02-02 00:00:00",
                "updated_at" => "2024-02-02 00:00:00"
            ],
            [
                "detail_id" => 3,
                "penjualan_id" => 3,
                "barang_id" => 3,
                "harga" => 1199000,
                "jumlah" => 1,
                "created_at" => "2024-03-03 00:00:00",
                "updated_at" => "2024-03-03 00:00:00"
            ],
            [
                "detail_id" => 4,
                "penjualan_id" => 4,
                "barang_id" => 4,
                "harga" => 1199000,
                "jumlah" => 1,
                "created_at" => "2024-04-04 00:00:00",
                "updated_at" => "2024-04-04 00:00:00"
            ],
            [
                "detail_id" => 5,
                "penjualan_id" => 5,
                "barang_id" => 5,
                "harga" => 4429000,
                "jumlah" => 1,
                "created_at" => "2024-05-05 00:00:00",
                "updated_at" => "2024-05-05 00:00:00"
            ],
            [
                "detail_id" => 6,
                "penjualan_id" => 6,
                "barang_id" => 6,
                "harga" => 1149000,
                "jumlah" => 1,
                "created_at" => "2024-06-06 00:00:00",
                "updated_at" => "2024-06-06 00:00:00"
            ],
            [
                "detail_id" => 7,
                "penjualan_id" => 7,
                "barang_id" => 7,
                "harga" => 2849000,
                "jumlah" => 1,
                "created_at" => "2024-07-07 00:00:00",
                "updated_at" => "2024-07-07 00:00:00"
            ],
            [
                "detail_id" => 8,
                "penjualan_id" => 8,
                "barang_id" => 8,
                "harga" => 2489000,
                "jumlah" => 1,
                "created_at" => "2024-08-08 00:00:00",
                "updated_at" => "2024-08-08 00:00:00"
            ],
            [
                "detail_id" => 9,
                "penjualan_id" => 9,
                "barang_id" => 9,
                "harga" => 2199000,
                "jumlah" => 1,
                "created_at" => "2024-09-09 00:00:00",
                "updated_at" => "2024-09-09 00:00:00"
            ],
            [
                "detail_id" => 10,
                "penjualan_id" => 10,
                "barang_id" => 10,
                "harga" => 3999000,
                "jumlah" => 1,
                "created_at" => "2024-10-10 00:00:00",
                "updated_at" => "2024-10-10 00:00:00"
            ],
            [
                "detail_id" => 11,
                "penjualan_id" => 11,
                "barang_id" => 11,
                "harga" => 1199000,
                "jumlah" => 1,
                "created_at" => "2024-11-11 00:00:00",
                "updated_at" => "2024-11-11 00:00:00"
            ],
            [
                "detail_id" => 12,
                "penjualan_id" => 12,
                "barang_id" => 12,
                "harga" => 3369000,
                "jumlah" => 1,
                "created_at" => "2024-12-12 00:00:00",
                "updated_at" => "2024-12-12 00:00:00"
            ],
        ];

        DB::table("t_penjualan_detail")->insert($data);
    }
}
