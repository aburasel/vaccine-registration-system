<?php

namespace Database\Factories;

use App\Models\VaccineCenter;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $vaccineCenterIds = VaccineCenter::pluck('id')->toArray();

        return [
            'name' => $this->faker->name(),
            'nid' => $this->faker->unique()->numberBetween(10000000, 20000000),
            'phone' => $this->faker->unique()->phoneNumber(),
            'email' => $this->faker->unique()->email(),
            'vaccine_center_id' => $this->faker->randomElement($vaccineCenterIds),
            'vaccination_status' => $this->faker->randomElement([1, 2, 3]),
        ];
    }
}
