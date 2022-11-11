<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PlayerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $gender = $this->faker->randomElement(['Male', 'Female']);

        return [
            'first_name' => $this->faker->firstName($gender),
            'last_name' => $this->faker->lastName($gender),
            'date_of_birth' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'age' => $this->faker->numberBetween(18,80),
            'gender' => $gender,
            'civil_status' => $this->faker->randomElement(['Single', 'Married']),
            'contact_number' => $this->faker->phoneNumber(),
            'street_address1' => $this->faker->streetAddress() ,
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
            'nationality' => 'Filipino',
            'occupation' => $this->faker->jobTitle(),
            'income_source' => 'Salary',
            'isBanned' => $this->faker->randomElement(['0', '1']),
            'validid_type1' => $this->faker->randomElement(['Drivers License', 'UMID','National ID', 'Passport']),
            'validid_number1' => $this->faker->numerify('#######'),
            'isBanned' => $this->faker->randomElement(['0', '1']),
            'created_at' => $this->faker->dateTimeBetween($startDate = '-1 year', $endDate = 'now')->format('Y-m-d'),

        ];
    }
}
