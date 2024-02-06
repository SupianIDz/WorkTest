<?php

namespace App\Domains\Reservation\Tests\Feature;

use App\Domains\Table\Models\Table;
use Illuminate\Cache\ArrayLock;
use Illuminate\Cache\ArrayStore;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class ReservationRaceConditionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    protected function setUp() : void
    {
        parent::setUp();

        $this->seedSettings();;
    }

    /**
     * @test
     */
    public function test()
    {
        $payload = [
            'seat'     => 3,
            'start_at' => '2024-02-07 14:00',
            'end_at'   => '2024-02-07 16:00',
        ];

        Table::factory(2)->create([
            'capacity' => 5,
            'status'   => Table::STATUS_ACTIVE,
        ]);

        Cache::shouldReceive('lock')->andReturn(new ArrayLock(
            new ArrayStore, 'reservation', 1000
        ));

        $response1 = $this->post(route('reservations.store'), $payload);

        $response1->assertCreated();
        $this->assertSame('Reservation created successfully', $response1->json('message'));

        $this->assertDatabaseCount('reservations', 1);

        $response2 = $this->post(route('reservations.store'), $payload);

        $response2
            ->assertStatus(409);

        $this->assertSame('Reservation creation is already in progress', $response2->json('message'));
    }
}
