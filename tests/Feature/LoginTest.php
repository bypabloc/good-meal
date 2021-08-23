<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Tests\TestCase;
use Session;

class LoginTest extends TestCase
{
    /** @test */
    public function it_visit_page_of_login()
    {
        $this->get('/login')
            ->assertStatus(200)
            ->assertSee('Login');
    }

    /** @test */
    public function authenticated_to_a_user()
    {
        DB::beginTransaction();

        $data = [
            'name' => 'Pablo Contreras',
            "email" => "pacg1991@gmail.com",
            "password" => "12345678",
        ];

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'email_verified_at' => now(),
        ]);

        $this->get('/login');
        $credentials = [
            'email' => $data['email'],
            "password" => $data['password'],
        ];
        $response = $this->post('/login', $credentials);
        $this->assertCredentials($credentials);

        DB::rollback();
    }

    /** @test */
    public function not_authenticate_to_a_user_with_credentials_invalid()
    {
        DB::beginTransaction();

        $data = [
            'name' => 'Pablo Contreras',
            "email" => "pacg1991@gmail.com",
            "password" => "12345678",
        ];

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'email_verified_at' => now(),
        ]);

        $this->get('/login');
        $credentials = [
            'email' => $data['email'],
            "password" => "123456789",
        ];
        $response = $this->post('/login', $credentials);
        $this->assertInvalidCredentials($credentials);

        DB::rollback();
    }

    /** @test */
    public function the_email_is_required_for_authenticate()
    {
        $this->get('/login');
        $credentials = [
            "email" => null,
            "password" => "12345678",
        ];
        $response = $this->post('/login', $credentials);
        $response->assertRedirect('/login')->assertSessionHasErrors([
            'email' => 'El campo email es obligatorio.',
        ]);
    }

    /** @test */
    public function the_password_is_required_for_authenticate()
    {
        $this->get('/login');
        $credentials = [
            "email" => "pacg1991@gmail.com",
            "password" => null,
        ];
        $response = $this->post('/login', $credentials);
        $response->assertRedirect('/login')->assertSessionHasErrors([
            'password' => 'El campo password es obligatorio.',
        ]);
    }
}
