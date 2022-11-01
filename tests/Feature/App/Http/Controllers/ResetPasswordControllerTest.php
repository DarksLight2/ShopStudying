<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\ResetPasswordController;
use Domain\Customer\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class ResetPasswordControllerTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     */
    public function page(): void
    {
        $args = [
            'token' => 'token'
        ];

        // Guest
        $this->get(action([ResetPasswordController::class, 'page'], $args))
            ->assertSee(view('auth.reset-password', $args))
            ->assertOk();

        // Authorized
        $user = User::factory()->create();
        $response = $this
            ->actingAs($user)
            ->get(action([ResetPasswordController::class, 'page'], $args));
        $response->assertRedirect(route('home'));
    }

    /**
     * @test
     */
    public function handle(): void
    {
        Event::fake();

        $user = User::factory()->create();

        $token = Str::random(64);

        DB::table('password_resets')
            ->insert([
                'email' => $user->email,
                'token' => bcrypt($token),
            ]);

        //Guest
        $response = $this->post(action([ResetPasswordController::class, 'handle']), [
            'email' => $user->email,
            'password' => '12345678',
            'password_confirmation' => '12345678',
            'token' => $token
        ]);

        $response->assertValid();

        $new_user_password = User::query()->where(['email' => $user->email])->first('password');

        $this->assertTrue(Hash::check(12345678, $new_user_password->password));

        Event::assertDispatched(PasswordReset::class);
        //Authorized
        $this
            ->actingAs($user)
            ->post(action([ResetPasswordController::class, 'handle']), [
                'email' => $user->email,
                'password' => '12345678',
                'password_confirmation' => '12345678',
                'token' => $token
            ])
            ->assertRedirect(route('home'));
    }
}