<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TransaksiModel>
 */
class TransaksiModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "user_id" => 1,
            "pembeli" => $this->faker->name(),
            "penjualan_kode" => "TRANS202412" . $this->faker->numberBetween(1000, 9999),
            "penjualan_tanggal" => $this->faker->dateTimeBetween('2024-12-01', '2024-12-30')->format('Y-m-d'),
            "created_at" => "2024-10-10 00:00:00",
            "updated_at" => "2024-10-10 00:00:00"
        ];
    }
}
