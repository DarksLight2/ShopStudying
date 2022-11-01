<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\SignInController;
use Domain\Customer\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SignInControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function page(): void
    {
        // Guest
        $this->get(action([SignInController::class, 'page']))
            ->assertSee(view('auth.sign-in'))
            ->assertOk();

        // Authorized
        $user = User::factory()->create();
        $response = $this
            ->actingAs($user)
            ->get(action([SignInController::class, 'page']));
        $response->assertRedirect(route('home'));
    }

    /**
     * @test
     */
    public function handle(): void
    {
        // Guest
        $user = User::factory()->create();

        $request = [
            'email' => $user->email,
            'password' => 'password',
        ];

        $response = $this->post(
            action([SignInController::class, 'handle']),
            $request
        );

        $response->assertValid();

        $this->assertAuthenticatedAs($user);

        // TODO flash()->info('Вы были успешно авторизированны!');

        $response
            ->assertRedirect(route('home'));

        // Authorized
        $response = $this
            ->actingAs($user)
            ->post(
                action([SignInController::class, 'handle']),
                $request
            );

        $response->assertRedirect(route('home'));
    }

    /**
     * @test
     */
    public function logout()
    {
        $user = User::factory()->create();

        // Guest
        $this->delete(action([SignInController::class, 'logout']))
            ->assertRedirect(route('auth.login'));
        // Authorized
        $response = $this
            ->actingAs($user)
            ->delete(action([SignInController::class, 'logout']));

        $this->assertGuest();

        $response->assertRedirect(route('home'));
    }
}