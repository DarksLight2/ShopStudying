<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\ForgotPasswordController;
use Domain\Customer\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ForgotPasswordControllerTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     */
    public function page(): void
    {
        // Guest
        $this->get(action([ForgotPasswordController::class, 'page']))
            ->assertSee(view('auth.forgot-password'))
            ->assertOk();

        // Authorized
        $user = User::factory()->create();
        $response = $this
            ->actingAs($user)
            ->get(action([ForgotPasswordController::class, 'page']));
        $response->assertRedirect(route('home'));
    }

    /**
     * @test
     */
    public function handle(): void
    {
        Notification::fake();

        $user = User::factory()->create([
            'email' => 'shop.loc@gmail.com'
        ]);

        //Guest
        $response = $this->post(action([ForgotPasswordController::class, 'handle']), [
            'email' => $user->email
        ]);

        Notification::assertSentTo($user, ResetPassword::class);

        $response
            ->assertValid()
            ->assertRedirect(route('home'));

        //Authorized
        $this->actingAs($user)
            ->post(action([ForgotPasswordController::class, 'handle']), [
                'email' => $user->email
            ])
            ->assertRedirect(route('home'));
    }
}