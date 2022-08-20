<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            ChurchSeeder::class,
            MenuSeeder::class
        ]);

        \App\Models\Role::where('role_name', 'Membro')
            ->first()
            ->members()
            ->create([
                'name' => "Gabriel Torres Brum",
                'gender' => "Masculino",
                'birthday' => "1999-04-01",
                'tither' => true,
                'user_id' => \App\Models\User::create([
                    'username' => 'gtorres',
                    'email' => 'gtorresbrum@hotmail.com',
                    'admin' => true,
                    'password' => Hash::make("12345678"),
                ])->id
            ]);
        \App\Models\Role::where('role_name', 'Membro')
            ->first()
            ->members()
            ->create([
                'name' => "Luciana Torres",
                'gender' => "Feminino",
                'birthday' => "1971-03-25",
                'tither' => true,
                'user_id' => \App\Models\User::create([
                    'username' => 'ltbrum',
                    'email' => 'lt.brum@uol.com.br',
                    'admin' => false,
                    'password' => Hash::make("12345678"),
                ])->id
            ]);

        // \App\Models\User::factory(10)
        //     ->count(50)
        //     ->hasMember()
        //     ->create();
    }
}
