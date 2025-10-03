<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $serviceNames = [
            'Laundry Kiloan',
            'Cuci Kering Setrika',
            'Laundry Satuan',
            'Cuci Sepatu',
            'Cuci Karpet',
            'Dry Cleaning',
        ];

        return [
            'nama_layanan' => fake()->randomElement($serviceNames),
            'deskripsi' => fake()->sentence(12),
            'harga' => fake()->numberBetween(5000, 50000),
            'satuan' => fake()->randomElement(['kg', 'pcs']),
        ];
    }
}
