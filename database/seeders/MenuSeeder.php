<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Menu::factory()->create([
            'label' => 'Painel',
            'route' => 'app.dashboard',
            'icon'  => 'home',
            'place' => 'sidebar',
            'admin' => false,
        ]);

        \App\Models\Menu::factory()->create([
            'label' => 'Membros',
            'route' => 'app.members',
            'icon'  => 'users',
            'place' => 'sidebar',
            'admin' => true,
        ]);

        \App\Models\Menu::factory()->create([
            'label' => 'Cargos',
            'route' => 'app.roles',
            'icon'  => 'identification',
            'place' => 'sidebar',
            'admin' => true,
        ]);

        \App\Models\Menu::factory()->create([
            'label' => 'Igrejas',
            'route' => 'app.churches',
            'icon'  => 'office-building',
            'place' => 'sidebar',
            'admin' => true,
        ]);
    }
}
