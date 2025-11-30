<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ServiceSeeder::class,
        ]);

        \App\Models\User::create([
            'name' => 'Admin User',
            'email' => 'admin@carrepair.com',
            'password' => bcrypt('password'),
            'user_type' => 'admin',
        ]);

        \App\Models\User::create([
            'name' => 'John Customer',
            'email' => 'customer@test.com',
            'password' => bcrypt('password'),
            'user_type' => 'customer',
            'phone' => '123-456-7890',
            'address' => '123 Main St, City',
        ]);

        \App\Models\User::create([
            'name' => 'Jane Shop Owner',
            'email' => 'shop@test.com',
            'password' => bcrypt('password'),
            'user_type' => 'shop_owner',
            'phone' => '098-765-4321',
            'address' => '456 Business Ave, City',
            'license_no' => 'LIC123456',
        ]);
    }
}
