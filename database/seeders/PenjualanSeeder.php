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
        $data = [
            [
                "penjualan_id" => 1,
                "user_id" => 1,
                "pembeli" => "Budi",
                "penjualan_kode" => "TRANS202401011",
                "penjualan_tanggal" => "2024-01-01 00:00:00",
                "created_at" => "2024-01-01 00:00:00",
                "updated_at" => "2024-01-01 00:00:00"
            ],
            [
                "penjualan_id" => 2,
                "user_id" => 1,
                "pembeli" => "Adit",
                "penjualan_kode" => "TRANS202401012",
                "penjualan_tanggal" => "2024-02-02 00:00:00",
                "created_at" => "2024-02-02 00:00:00",
                "updated_at" => "2024-02-02 00:00:00"
            ],
            [
                "penjualan_id" => 3,
                "user_id" => 1,
                "pembeli" => "Adam",
                "penjualan_kode" => "TRANS202401013",
                "penjualan_tanggal" => "2024-03-03 00:00:00",
                "created_at" => "2024-03-03 00:00:00",
                "updated_at" => "2024-03-03 00:00:00"
            ],
            [
                "penjualan_id" => 4,
                "user_id" => 1,
                "pembeli" => "Putra",
                "penjualan_kode" => "TRANS202401014",
                "penjualan_tanggal" => "2024-04-04 00:00:00",
                "created_at" => "2024-04-04 00:00:00",
                "updated_at" => "2024-04-04 00:00:00"
            ],
            [
                "penjualan_id" => 5,
                "user_id" => 1,
                "pembeli" => "Zakaria",
                "penjualan_kode" => "TRANS202401015",
                "penjualan_tanggal" => "2024-05-05 00:00:00",
                "created_at" => "2024-05-05 00:00:00",
                "updated_at" => "2024-05-05 00:00:00"
            ],
            [
                "penjualan_id" => 6,
                "user_id" => 1,
                "pembeli" => "Muzaki",
                "penjualan_kode" => "TRANS202401016",
                "penjualan_tanggal" => "2024-06-06 00:00:00",
                "created_at" => "2024-06-06 00:00:00",
                "updated_at" => "2024-06-06 00:00:00"
            ],
            [
                "penjualan_id" => 7,
                "user_id" => 1,
                "pembeli" => "Vunky",
                "penjualan_kode" => "TRANS202401017",
                "penjualan_tanggal" => "2024-07-07 00:00:00",
                "created_at" => "2024-07-07 00:00:00",
                "updated_at" => "2024-07-07 00:00:00"
            ],
            [
                "penjualan_id" => 8,
                "user_id" => 1,
                "pembeli" => "Himawan",
                "penjualan_kode" => "TRANS202401018",
                "penjualan_tanggal" => "2024-08-08 00:00:00",
                "created_at" => "2024-08-08 00:00:00",
                "updated_at" => "2024-08-08 00:00:00"
            ],
            [
                "penjualan_id" => 9,
                "user_id" => 1,
                "pembeli" => "Eddo",
                "penjualan_kode" => "TRANS202401019",
                "penjualan_tanggal" => "2024-09-09 00:00:00",
                "created_at" => "2024-09-09 00:00:00",
                "updated_at" => "2024-09-09 00:00:00"
            ],
            [
                "penjualan_id" => 10,
                "user_id" => 1,
                "pembeli" => "Raihan",
                "penjualan_kode" => "TRANS2024010110",
                "penjualan_tanggal" => "2024-10-10 00:00:00",
                "created_at" => "2024-10-10 00:00:00",
                "updated_at" => "2024-10-10 00:00:00"
            ],
            [
                "penjualan_id" => 11,
                "user_id" => 1,
                "pembeli" => "Fathur",
                "penjualan_kode" => "TRANS2024010111",
                "penjualan_tanggal" => "2024-11-11 00:00:00",
                "created_at" => "2024-11-11 00:00:00",
                "updated_at" => "2024-11-11 00:00:00"
            ],
            [
                "penjualan_id" => 12,
                "user_id" => 1,
                "pembeli" => "Efendy",
                "penjualan_kode" => "TRANS2024010112",
                "penjualan_tanggal" => "2024-12-12 00:00:00",
                "created_at" => "2024-12-12 00:00:00",
                "updated_at" => "2024-12-12 00:00:00"
            ],
        ];

        DB::table("t_penjualan")->insert($data);
    }
}
