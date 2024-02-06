<?php

namespace App\Domains\Table\Tests\Feature;

use App\Domains\Table\Models\Table;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TableTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    protected function setUp() : void
    {
        parent::setUp();

        $this->seedSettings();
    }

    /**
     * @test
     */
    public function getAvailableTablesWithSlots()
    {
        Table::factory(1)->create([
            'capacity' => 5,
            'status'   => Table::STATUS_ACTIVE,
        ]);

        $response = $this->json('GET', route('table.availability'), [
            'date' => now()->format('Y-m-d'),
        ]);

        $response
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'code',
                        'capacity',
                        'slots',
                    ],
                ],
            ]);

        $slots = [
            "09:00 - 10:00" => true,
            "10:00 - 11:00" => true,
            "11:00 - 12:00" => true,
            "12:00 - 13:00" => true,
            "13:00 - 14:00" => true,
            "14:00 - 15:00" => true,
            "15:00 - 16:00" => true,
            "16:00 - 17:00" => true,
            "17:00 - 18:00" => true,
            "18:00 - 19:00" => true,
            "19:00 - 20:00" => true,
            "20:00 - 21:00" => true,
            "21:00 - 22:00" => true,
        ];

        $this->assertEquals($slots, $response->json('data.0.slots'));
    }
}
