<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory()->create([
        //     'username' => 'gabriel',
        //     'email' => 'gabriel@gmail.com',
        //     'admin' => true,
        // ]);

        $this->call([
            RoleSeeder::class,
            ChurchSeeder::class,
        ]);

        // \App\Models\User::factory(10)
        //     ->count(50)
        //     ->hasMember()
        //     ->create();
    }
}
