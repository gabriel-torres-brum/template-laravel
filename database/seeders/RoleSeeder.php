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
            'role_name' => 'member',
            'description' => 'Membro',
            'gender' => 'Ambos'
        ]);

        Role::factory()->create([
            'role_name' => 'workerM',
            'description' => 'Obreiro',
            'gender' => 'Masculino'
        ]);

        Role::factory()->create([
            'role_name' => 'deacon',
            'description' => 'Diácono',
            'gender' => 'Masculino'
        ]);

        Role::factory()->create([
            'role_name' => 'presbyter',
            'description' => 'Presbítero',
            'gender' => 'Masculino'
        ]);

        Role::factory()->create([
            'role_name' => 'evangelist',
            'description' => 'Evangelista',
            'gender' => 'Masculino'
        ]);

        Role::factory()->create([
            'role_name' => 'pastor',
            'description' => 'Pastor',
            'gender' => 'Masculino'
        ]);

        Role::factory()->create([
            'role_name' => 'workerF',
            'description' => 'Obreira',
            'gender' => 'Feminino'
        ]);

        Role::factory()->create([
            'role_name' => 'missionary',
            'description' => 'Missionária',
            'gender' => 'Feminino'
        ]);
    }
}
