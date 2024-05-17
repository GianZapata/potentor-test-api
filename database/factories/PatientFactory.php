<?php

namespace Database\Factories;

use App\Enums\PatientTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{

    private $types = [PatientTypeEnum::Analysis, PatientTypeEnum::PregnantTest, PatientTypeEnum::Biometric];

    public function definition(): array
    {
        return [
            'name'              => $this->faker->name,
            'second_name'       => $this->faker->name,
            'last_name'         => $this->faker->lastName(),
            'second_last_name'  => $this->faker->lastName(),
            'age'               => $this->faker->numberBetween(0, 100),
            'type'              => $this->faker->randomElement( $this->types ),
        ];
    }
}
