<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'nama_layanan' => 'Laundry Kiloan',
                'deskripsi' => 'Layanan cuci lipat kiloan cepat dan higienis.',
                'harga' => 7000,
                'satuan' => 'kg',
            ],
            [
                'nama_layanan' => 'Cuci Kering Setrika',
                'deskripsi' => 'Paket lengkap cuci, kering, dan setrika.',
                'harga' => 12000,
                'satuan' => 'kg',
            ],
            [
                'nama_layanan' => 'Cuci Sepatu',
                'deskripsi' => 'Perawatan sepatu kanvas, kulit, dan suede.',
                'harga' => 35000,
                'satuan' => 'pcs',
            ],
            [
                'nama_layanan' => 'Cuci Karpet',
                'deskripsi' => 'Pembersihan mendalam untuk karpet rumah dan kantor.',
                'harga' => 20000,
                'satuan' => 'kg',
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(
                ['nama_layanan' => $service['nama_layanan']],
                $service
            );
        }
    }
}
