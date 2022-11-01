<?php

namespace App\Http\Controllers;

use App\Events\RegistrationEvent;
use App\Listeners\SendEmailNewUserListener;
use App\Notifications\NewUserNotification;
use Domain\Customer\Models\User;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Laravel\Socialite\Facades\Socialite;
use Mockery;
use Tests\TestCase;

class SocialAuthControllerTest extends TestCase
{
    /**
     * @test
     */
    public function redirect(): void
    {
        $this->get(route('auth.socialite', ['github']))->assertRedirect();
    }

    public function test_callback(): void
    {
        Event::fake();
        Notification::fake();

        $github_user = Mockery::mock('Laravel\Socialite\Two\User');
        $github_user->shouldReceive('getId')->andReturn(123456789);
        $github_user->shouldReceive('getName')->andReturn('Test Test');
        $github_user->shouldReceive('getNickname')->andReturn('Test');
        $github_user->shouldReceive('getEmail')->andReturn('shop.loc@gmail.com');
        $github_user->shouldReceive('getAvatar')->andReturn(
            'https://st2.depositphotos.com/1471096/7466/i/600/depositphotos_74661735-stock-photo-angry-wolf-head.jpg'
        );

        $github = Mockery::mock('Laravel\Socialite\Contracts\Provider');

        $github->shouldReceive('user')->andReturn($github_user);

        Socialite::shouldReceive('driver')->with('github')->andReturn($github);

        $this->get(route('auth.socialite.callback', ['github']))
            ->assertRedirect(route('home'));

        $avatar_name = str($github->user()->getName())->slug()->value();

        $this->assertDatabaseHas('users', [
            'email' => $github->user()->getEmail(),
            'provider' => 'github',
            'provider_id' => $github->user()->getId(),
            'avatar' => 'avatars/' . $avatar_name . '.png'
        ]);

        $user = User::query()->where([
            'email' => $github->user()->getEmail()
        ])->first();

        $this->assertAuthenticatedAs($user);

        Event::assertListening(RegistrationEvent::class, SendEmailNewUserListener::class);

        $event = new RegistrationEvent($user);
        $listener = new SendEmailNewUserListener();
        $listener->handle($event);

        Notification::assertSentTo($user, NewUserNotification::class);
    }
}