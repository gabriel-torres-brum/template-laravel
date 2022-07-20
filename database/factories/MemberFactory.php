<?php

namespace Database\Factories;

use App\Models\Church;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'      => fake()->name(),
            'gender'    => fake()->randomElement(['Masculino', 'Feminino']),
            'birthday'  => fake()->dateTimeBetween('1950-01-01', '2021-12-31'),
            // ->format('d/m/Y')
            'tither'    => fake()->boolean(),
            'user_id'   => User::factory(),
            'role_id'   => Role::all()->where('gender', 'Masculino')->random()->id,
            'church_id' => Church::all()->random()->id,
        ];
    }
}
