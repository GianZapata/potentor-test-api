<?php

namespace Database\Seeders;

use Database\Factories\PatientFactory;
use Database\Factories\PatientRecordFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        PatientFactory::new()->count(10)->create()->each(function ($patient) use( $faker ) {
            $count = $faker->numberBetween(1, 5);
            PatientRecordFactory::new()->count($count)->create([
                'patient_id' => $patient->id,
            ]);
        });
    }
}
