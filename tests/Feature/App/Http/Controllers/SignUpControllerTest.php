<?php

namespace App\Http\Controllers;

use App\Events\RegistrationEvent;
use App\Http\Controllers\Auth\SignUpController;
use App\Listeners\SendEmailNewUserListener;
use App\Notifications\NewUserNotification;
use Domain\Customer\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class SignUpControllerTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     */
    public function page(): void
    {
        // Guest
        $this->get(action([SignUpController::class, 'page']))
            ->assertSee(view('auth.sign-up'))
            ->assertOk();

        // Authorized
        $user = User::factory()->create();
        $response = $this
            ->actingAs($user)
            ->get(action([SignUpController::class, 'page']));
        $response->assertRedirect(route('home'));
    }

    /**
     * @test
     */
    public function handle(): void
    {
        Notification::fake();
        Event::fake();

        $request = [
            'name' => 'Test',
            'email' => 'test@gmail.com',
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ];

        $this->assertDatabaseMissing('users', [
            'email' => $request['email'],
        ]);

        $response = $this->post(
            action([SignUpController::class, 'handle']),
            $request
        );

        $response->assertValid();

        $this->assertDatabaseHas('users', [
            'email' => $request['email'],
        ]);

        $user = User::query()
            ->where([
                'email' => $request['email'],
            ])->first();

        Event::assertDispatched(RegistrationEvent::class);
        Event::assertListening(RegistrationEvent::class, SendEmailNewUserListener::class);

        $event = new RegistrationEvent($user);
        $listener = new SendEmailNewUserListener();
        $listener->handle($event);

        Notification::assertSentTo($user, NewUserNotification::class);

        $response->assertRedirect(route('home'));
    }
}