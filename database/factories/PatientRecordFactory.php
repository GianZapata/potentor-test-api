<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PatientRecord>
 */
class PatientRecordFactory extends Factory
{
    private $bloodTypes = [
        'A+',
        'A-',
        'B+',
        'B-',
        'O+',
        'O-',
    ];

    public function definition(): array
    {
        $name = 'Básico ' . $this->faker->numberBetween(1, 100);
        $birthDate = $this->faker->dateTimeBetween('-30 years', 'now');
        return [
            'name'          => $name,
            'blood_type'    => $this->faker->randomElement( $this->bloodTypes ),
            'birth_date'    => $birthDate,
            'ph'            => $this->faker->boolean ? $this->faker->numberBetween(1, 14) : null
        ];
    }
}
