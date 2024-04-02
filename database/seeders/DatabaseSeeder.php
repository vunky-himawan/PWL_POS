<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\DetailTransaksiModel;
use App\Models\TransaksiModel;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            LevelSeeder::class,
            UserSeeder::class,
            KategoriSeeder::class,
            BarangSeeder::class,
            StokSeeder::class,
            PenjualanSeeder::class,
            PenjualanDetailSeeder::class,
        ]);

        // TransaksiModel::factory(10)->create();
        // DetailTransaksiModel::factory(10)->create();
    }
}
