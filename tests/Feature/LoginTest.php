<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Tests\TestCase;
use Session;

class LoginTest extends TestCase
{
    /** @test */
    public function it_visit_page_of_login()
    {
        $this->get('/login')
            ->assertStatus(200);
    }

    /** @test */
    public function authenticated_to_a_user()
    {
        $this->get('/login');
        $credentials = [
            "email" => "pacg@mail.com",
            "password" => "12345678"
        ];
        $response = $this->post('/login', $credentials);
        $this->assertCredentials($credentials);
    }

    /** @test */
    public function not_authenticate_to_a_user_with_credentials_invalid()
    {
        $this->get('/login');
        $credentials = [
            "email" => "pacg@mail.com",
            "password" => "123456789"
        ];
        $response = $this->post('/login', $credentials);
        $this->assertInvalidCredentials($credentials);
    }

    /*
    public function the_email_is_required_for_authenticate()
    {
        $this->get('/login');
        $credentials = [
            "email" => null,
            "password" => "12345678"
        ];
        $response = $this->post('/login', $credentials);
        $this->assertInvalidCredentials($credentials);

        $response->assertSessionHasErrors([
            'email' => 'The email field is required.',
        ]);
    }
    */
}
