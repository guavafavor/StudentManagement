<?php

namespace Database\Factories;

use App\Models\School;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $gender = $this->faker->randomElement(['male','female']);
        $schools = School::all()->pluck('id');

        return [
            'stu_id' => $this->faker->regexify('[A-Z0-9]{4}'),
            'username' => $this->faker->userName(),
            'firstname' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(),
            'gender' => $gender,
            'email' => $this->faker->email(),
            'phone' => $this->faker->phoneNumber(),
            'identification' => $this->faker->regexify('[0-9]{12}'),
            'address' => $this->faker->address(),
            'school_id' => School::inRandomOrder()->first()->id,
            'created_at' => now()
        ];
    }
}
