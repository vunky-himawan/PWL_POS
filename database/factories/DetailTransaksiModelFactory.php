<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetailTransaksiModel>
 */
class DetailTransaksiModelFactory extends Factory
{
    private static $counter = 123;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $penjualan_id = self::$counter;
        self::$counter++;

        return [
            "penjualan_id" => $penjualan_id,
            "barang_id" => $this->faker->numberBetween(1, 12),
            "harga" => $this->faker->numberBetween(1000000, 10000000),
            "jumlah" => $this->faker->numberBetween(1, 10),
            "created_at" => "2024-12-12 00:00:00",
            "updated_at" => "2024-12-12 00:00:00"
        ];
    }
}
