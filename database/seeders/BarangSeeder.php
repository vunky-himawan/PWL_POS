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

        $data = [
            [
                "barang_id" => 1,
                "kategori_id" => 1,
                "barang_kode" => "NCAZVP2P",
                "barang_nama" => "NikeCourt Air Zoom Vapor Pro 2 Premium ",
                "harga_beli" => 1000000,
                "harga_jual" => 10000000,
                "created_at" => "2024-01-01 00:00:00",
                "updated_at" => "2024-01-01 00:00:00"
            ],
            [
                "barang_id" => 2,
                "kategori_id" => 2,
                "barang_kode" => "NAZVT3B",
                "barang_nama" => "Nike Air Zoom Victory Tour 3 Boa",
                "harga_beli" => 2000000,
                "harga_jual" => 3269000,
                "created_at" => "2024-02-02 00:00:00",
                "updated_at" => "2024-02-02 00:00:00"
            ],
            [
                "barang_id" => 3,
                "kategori_id" => 3,
                "barang_kode" => "NIRSE",
                "barang_nama" => "Nike Interact Run SE",
                "harga_beli" => 500000,
                "harga_jual" => 1199000,
                "created_at" => "2024-03-03 00:00:00",
                "updated_at" => "2024-03-03 00:00:00"
            ],
            [
                "barang_id" => 4,
                "kategori_id" => 4,
                "barang_kode" => "Z3MUDLBPF",
                "barang_nama" => "Zion 3 M.U.D. Light Bone PF",
                "harga_beli" => 200000,
                "harga_jual" => 1199000,
                "created_at" => "2024-04-04 00:00:00",
                "updated_at" => "2024-04-04 00:00:00"
            ],
            [
                "barang_id" => 5,
                "kategori_id" => 5,
                "barang_kode" => "NS9EMDS",
                "barang_nama" => "Nike Superfly 9 Elite Mercurial Dream Speed",
                "harga_beli" => 1250000,
                "harga_jual" => 4429000,
                "created_at" => "2024-05-05 00:00:00",
                "updated_at" => "2024-05-05 00:00:00"
            ],
            [
                "barang_id" => 6,
                "kategori_id" => 1,
                "barang_kode" => "NCL4",
                "barang_nama" => "NikeCourt Lite 4",
                "harga_beli" => 200000,
                "harga_jual" => 1149000,
                "created_at" => "2024-06-06 00:00:00",
                "updated_at" => "2024-06-06 00:00:00"
            ],
            [
                "barang_id" => 7,
                "kategori_id" => 2,
                "barang_kode" => "NAZVT3",
                "barang_nama" => "Nike Air Zoom Victory Tour 3",
                "harga_beli" => 500000,
                "harga_jual" => 2849000,
                "created_at" => "2024-07-07 00:00:00",
                "updated_at" => "2024-07-07 00:00:00"
            ],
            [
                "barang_id" => 8,
                "kategori_id" => 3,
                "barang_kode" => "NPT4GT",
                "barang_nama" => "Nike Pegasus Trail 4 GORE-TEX",
                "harga_beli" => 500000,
                "harga_jual" => 2489000,
                "created_at" => "2024-08-08 00:00:00",
                "updated_at" => "2024-08-08 00:00:00"
            ],
            [
                "barang_id" => 9,
                "kategori_id" => 4,
                "barang_kode" => "AJL312L",
                "barang_nama" => "Air Jordan Legacy 312 Low",
                "harga_beli" => 500000,
                "harga_jual" => 2199000,
                "created_at" => "2024-09-09 00:00:00",
                "updated_at" => "2024-09-09 00:00:00"
            ],
            [
                "barang_id" => 10,
                "kategori_id" => 5,
                "barang_kode" => "NV15EMDS",
                "barang_nama" => "Nike Vapor 15 Elite Mercurial Dream Speed",
                "harga_beli" => 1200000,
                "harga_jual" => 3999000,
                "created_at" => "2024-10-10 00:00:00",
                "updated_at" => "2024-10-10 00:00:00"
            ],
            [
                "barang_id" => 11,
                "kategori_id" => 1,
                "barang_kode" => "NCVL2",
                "barang_nama" => "NikeCourt Vapor Lite 2",
                "harga_beli" => 200000,
                "harga_jual" => 1199000,
                "created_at" => "2024-11-11 00:00:00",
                "updated_at" => "2024-11-11 00:00:00"
            ],
            [
                "barang_id" => 12,
                "kategori_id" => 2,
                "barang_kode" => "AJ9G",
                "barang_nama" => "Air Jordan 9 G",
                "harga_beli" => 800000,
                "harga_jual" => 3369000,
                "created_at" => "2024-12-12 00:00:00",
                "updated_at" => "2024-12-12 00:00:00"
            ],
        ];
        DB::table('m_barang')->insert($data);
    }
}
