<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            #'mobileno' => $this->faker->unique()->phoneNumber(),
            'mobileno' => $this->faker->numerify('09#########'),
            'email' => $this->faker->unique()->safeEmail(),
            'profilepic' => $this->faker->image('public/assets/images',30,30, null, false),
            'status' => $this->faker->randomElement([1,2])
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                //'email_verified_at' => null,
            ];
        });
    }
}
