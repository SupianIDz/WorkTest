<?php

namespace App\Domains\Reservation\Tests\Feature;

use App\Domains\Reservation\Models\Reservation;
use App\Domains\Table\Models\Table;
use App\Domains\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReservationTest extends TestCase
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
    public function tryReserveATableWithSignIn()
    {
        $user = User::factory()->create([
            //
        ]);

        Table::factory(2)->create([
            'capacity' => 5,
            'status'   => Table::STATUS_ACTIVE,
        ]);

        $payload = [
            'seat'     => 3,
            'start_at' => '2024-02-07 14:00',
            'end_at'   => '2024-02-07 16:00',
        ];

        $response = $this->actingAs($user)->post(route('reservations.store'), $payload);

        $response
            ->assertCreated();

        $this->assertDatabaseCount('reservations', 1);

        // check that the reservation matches the person who has made the reservation
        $this->assertDatabaseHas('reservations', array_merge($payload, [
            'user_id' => $user->getKey(),
        ]));
    }

    /**
     * @test
     */
    public function tryReserveATableWithoutSignIn()
    {
        Table::factory(2)->create([
            'capacity' => 5,
            'status'   => Table::STATUS_ACTIVE,
        ]);

        $payload = [
            'seat'     => 3,
            'start_at' => '2024-02-07 14:00',
            'end_at'   => '2024-02-07 16:00',
        ];

        $response = $this->post(route('reservations.store'), $payload);

        $response
            ->assertCreated();

        $this->assertDatabaseCount('reservations', 1);
        $this->assertDatabaseHas('reservations', array_merge($payload, [
            'user_id' => null,
        ]));
    }

    /**
     * @test
     */
    public function tryReserveATableThatHasBeenReserved()
    {
        $user = User::factory()->create([
            //
        ]);

        $payload = [
            'seat'     => 3,
            'start_at' => '2024-02-07 14:00',
            'end_at'   => '2024-02-07 16:00',
        ];

        Table::factory(1)->create([
            'status'   => Table::STATUS_ACTIVE,
            'capacity' => 5,
        ]);

        Reservation::create(array_merge($payload, [
            'user_id'  => $user->getKey(),
            'table_id' => Table::first()->getKey(),
        ]));

        $response = $this->actingAs($user)->json('POST', route('reservations.store'), $payload);

        $response
            ->assertStatus(400)
            ->assertJson([
                'message' => 'No available tables',
            ]);

        $this->assertDatabaseCount('reservations', 1);
    }
}
