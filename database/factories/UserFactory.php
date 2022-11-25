<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $gender = $this->faker->randomElement(['male','female']);

        return [
            'username' => $this->faker->userName(),
            'email' => $this->faker->email(),
            'password' => bcrypt('123456'),
            'firstname' => $this->faker->firstName($gender),
            'lastname' => $this->faker->lastName(),
            'gender' => $gender,
            'phone' => $this->faker->phoneNumber(),
            'role_id' => $this->faker->randomElement([1, 2]),
            'created_at' => now()
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
