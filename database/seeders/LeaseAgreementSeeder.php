<?php

namespace Database\Seeders;

use App\Models\LeaseAgreement;
use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeaseAgreementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LeaseAgreement::factory(30)->create()->each(function ($lease) {
            Payment::factory(rand(1, 5))->create(['lease_id' => $lease->id]);
        });
    }
}
