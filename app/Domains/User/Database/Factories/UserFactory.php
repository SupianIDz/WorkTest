<?php

namespace App\Domains\User\Database\Factories;

use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * @return array
     */
    public function definition() : array
    {
        return [
            'name'     => fake()->name(),
            'email'    => fake()->safeEmail(),
            'password' => bcrypt('secret'),
        ];
    }
}
