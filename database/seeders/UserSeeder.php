<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin Laundry',
            'email' => 'admin@laundry.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Create Regular User
        User::create([
            'name' => 'User Pelanggan',
            'email' => 'user@laundry.com',
            'password' => Hash::make('user123'),
            'role' => 'user',
        ]);

        $this->command->info('Default users created successfully!');
        $this->command->info('Admin: admin@laundry.com / admin123');
        $this->command->info('User: user@laundry.com / user123');
    }
}
