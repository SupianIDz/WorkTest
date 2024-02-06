<?php

namespace Database\Seeders;

use App\Domains\Reservation\Models\Reservation;
use App\Domains\Setting\Models\Setting;
use App\Domains\Table\Models\Table;
use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run() : void
    {
        $this->seedSettings();

        User::factory()->create([
            'email' => 'test@example.com',
        ]);

        User::factory(20)->create([

        ]);

        Table::factory(2)->create([

        ]);

//        Reservation::factory(3)
//            ->state(new Sequence(function () {
//                return [
//                    'user_id'  => User::inRandomOrder()->first(),
//                    'table_id' => Table::active()->inRandomOrder()->first(),
//                ];
//            }))
//            ->create();
    }

    /**
     * @return void
     */
    private function seedSettings() : void
    {
        Setting::create([
            'key' => 'opening',
            'val' => '09:00',
        ]);

        Setting::create([
            'key' => 'closing',
            'val' => '22:00',
        ]);
    }
}
