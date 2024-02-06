<?php

namespace App\Domains\Table\Database\Factories;

use App\Domains\Table\Models\Table;
use Illuminate\Database\Eloquent\Factories\Factory;

class TableFactory extends Factory
{
    protected $model = Table::class;

    public function definition() : array
    {
        return [
            'capacity' => fake()->numberBetween(1, 10),
            'status'   => fake()->randomElement([
                Table::STATUS_ACTIVE, Table::STATUS_INACTIVE,
            ]),
        ];
    }
}
