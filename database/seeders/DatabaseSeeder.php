<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AboutSeeder::class,
            FounderSeeder::class,
            ContactSeeder::class,
            PropertyTypeSeeder::class,
            LocationSeeder::class,
            AmenitySeeder::class,
            PropertySeeder::class,
            TenantSeeder::class,
            PropertyMediaSeeder::class,
            LeaseAgreementSeeder::class,
            MaintenanceSeeder::class,
            PropertyAmenitySeeder::class,
            ServiceAvailabilitySeeder::class,
        ]);
    }
}
