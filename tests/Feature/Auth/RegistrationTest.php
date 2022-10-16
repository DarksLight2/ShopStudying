<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_rendering_registration_pages()
    {
        $user = User::factory()->create();

        // guests
        $response = $this->get('/register');

        $response->assertStatus(200);

        $response = $this->get('/register-email');

        $response->assertStatus(200);

        // authorized users
        $response = $this->actingAs($user)->get('/register');

        $response->assertRedirect(route('home'));

        $response = $this->actingAs($user)->get('/register-email');

        $response->assertRedirect(route('home'));
    }

    public function test_registration()
    {
        $user = User::factory()->create();

        // guests
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('home'));

        // authorized users
        $response = $this->actingAs($user)->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertRedirect(route('home'));
    }

    /**
     * @dataProvider fields
     */
    public function test_provided_data_validation($params)
    {
        $data = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $data[$params['field']] = $params['value'];

        $response = $this->post('/register', $data);

        $this->assertEquals($params['result'], $this->isAuthenticated());

        $response->assertRedirect(route('home'));
    }

    public function fields(): array
    {
        return [
            [
                [
                    'field' => 'name',
                    'value' => 'User',
                    'result' => false,
                ]
            ],
            [
                [
                    'field' => 'name',
                    'value' => 'User ',
                    'result' => false,
                ]
            ],
            [
                [
                    'field' => 'name',
                    'value' => 'User Test',
                    'result' => true,
                ]
            ],
            [
                [
                    'field' => 'email',
                    'value' => 'example@mail.com',
                    'result' => true,
                ]
            ],
            [
                [
                    'field' => 'email',
                    'value' => 'example@',
                    'result' => false,
                ]
            ],
            [
                [
                    'field' => 'password',
                    'value' => '',
                    'result' => false,
                ]
            ],
        ];
    }
}
