<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = $this->faker->randomElement(['I' , 'C']);

        // Put the name According to the type of the customer
        $name = $type == 'I' ? $this->faker->name : $this->faker->company;
        return [
            'name'        => $name,
            'type'        => $type,
            'state'       => $this->faker->state,
            'email'       => $this->faker->email,
            'address'     => $this->faker->streetAddress,
            'city'        =>$this->faker->city,
            'postal_code' => $this->faker->postcode

        ];
    }
}
