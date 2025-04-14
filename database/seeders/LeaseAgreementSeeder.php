<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\LeaseAgreement;
use App\Models\Payment;
use Illuminate\Database\Seeder;

final class LeaseAgreementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LeaseAgreement::factory(30)->create()->each(function ($lease) {
            Payment::factory(random_int(1, 5))->create(['lease_id' => $lease->id]);
        });
    }
}
