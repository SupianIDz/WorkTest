<?php

namespace App\Domains\User\Tests\Feature;

use App\Domains\User\Models\User;
use Tests\TestCase;

class SignInTest extends TestCase
{
    /**
     * @test
     */
    public function signIn()
    {
        $user = User::factory()->create();

        $response = $this->post(route('auth.signin'), [
            'email'    => $user->email,
            'password' => 'secret',
        ]);

        $response
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'name', 'email', 'token',
                ],
            ]);
    }

    /**
     * @test
     */
    public function failedSignIn()
    {
        $user = User::factory()->create();

        $response = $this->post(route('auth.signin'), [
            'email'    => $user->email,
            'password' => 'wrongpassword',
        ]);

        $response
            ->assertUnprocessable();
    }
}
