<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::factory()->create([
            'role_name' => 'Membro',
            'gender' => 'Ambos'
        ]);

        Role::factory()->create([
            'role_name' => 'Obreiro',
            'gender' => 'Masculino'
        ]);

        Role::factory()->create([
            'role_name' => 'Diácono',
            'gender' => 'Masculino'
        ]);

        Role::factory()->create([
            'role_name' => 'Presbítero',
            'gender' => 'Masculino'
        ]);

        Role::factory()->create([
            'role_name' => 'Evangelista',
            'gender' => 'Masculino'
        ]);

        Role::factory()->create([
            'role_name' => 'Pastor',
            'gender' => 'Masculino'
        ]);

        Role::factory()->create([
            'role_name' => 'Obreira',
            'gender' => 'Feminino'
        ]);

        Role::factory()->create([
            'role_name' => 'Missionária',
            'gender' => 'Feminino'
        ]);
    }
}
