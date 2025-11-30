<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            ['service_name' => 'Oil Change', 'description' => 'Complete oil and filter change', 'category' => 'Maintenance'],
            ['service_name' => 'Brake Repair', 'description' => 'Brake pads and rotor service', 'category' => 'Repair'],
            ['service_name' => 'Tire Rotation', 'description' => 'Rotate and balance tires', 'category' => 'Maintenance'],
            ['service_name' => 'Engine Diagnostics', 'description' => 'Computer diagnostics for engine issues', 'category' => 'Diagnostics'],
            ['service_name' => 'AC Service', 'description' => 'Air conditioning system check and refill', 'category' => 'Maintenance'],
            ['service_name' => 'Battery Replacement', 'description' => 'Replace car battery', 'category' => 'Repair'],
            ['service_name' => 'Wheel Alignment', 'description' => 'Four-wheel alignment service', 'category' => 'Maintenance'],
            ['service_name' => 'Transmission Service', 'description' => 'Transmission fluid change and inspection', 'category' => 'Maintenance'],
            ['service_name' => 'Suspension Repair', 'description' => 'Shock and strut replacement', 'category' => 'Repair'],
            ['service_name' => 'Paint and Body Work', 'description' => 'Cosmetic repair and painting', 'category' => 'Body Work'],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
