<?php

namespace Database\Factories;

use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'address_name' => fake()->streetName(),
            'number'       => fake()->numberBetween(10, 10000),
            'adjunct'      => fake()->sentence(5),
            'district'     => fake()->sentence(5),
            'city'         => fake()->sentence(5),
            'state'        => fake()->randomElement(['RJ', 'PA', 'SP', 'RR', 'MG', 'CE']),
            'cep'          => fake()->numerify('####-###'),
            'member_id'    => Member::all()->random()->id
        ];
    }
}
