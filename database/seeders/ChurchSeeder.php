<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Church;
use App\Models\Member;
use App\Models\Phone;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChurchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Church::factory()
            ->count(10)
            ->create()
            ->each(function ($church) {
                $members = Member::factory()
                    ->count(5)
                    ->create()
                    ->each(function ($member) {
                        $addresses = Address::factory()->count(2)->make();
                        $phones = Phone::factory()->count(2)->make();

                        $member->addresses()->saveMany($addresses);
                        $member->phones()->saveMany($phones);
                    });
                $church->members()->saveMany($members);
            });
    }
}
