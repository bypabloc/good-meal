<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

use App\Models\Subcription;
use App\Models\User;

class SubcripcionesTest extends TestCase
{
    /** @test */
    public function it_visit_page_root()
    {
        $this->get('/')
            ->assertStatus(200);
    }

    /** @test */
    public function validate_email()
    {
        $data = User::factory()->create();
        $data['password'] = 'password';

        $this->get('/login');
        $credentials = [
            'email' => $data['email'],
            "password" => $data['password'],
        ];
        $response = $this->post('/login', $credentials);
        $this->assertCredentials($credentials);

        $data = [
            "email" => "pacg1991",
        ];
        $response = $this->post('/subcribirse/check_email', $data);
        $response->assertStatus(302)->assertSessionHasErrors([
            'email' => 'El campo email debe ser una dirección de correo válida.',
        ]);
    }

    /** @test */
    public function validate_email_true()
    {
        $data = [
            "email" => "pacg1991@gmail.com",
        ];

        $response = $this->post('/subcribirse/check_email', $data);
        $response->assertStatus(200);
    }

    /** @test */
    public function email_exists()
    {
        DB::beginTransaction();

        $data = [
            "email" => "pacg1991@gmail.com",
            "names" => "Pablo Contreras",
            "number" => "5646546",
            "canal_marketing" => "1",
        ];
        Subcription::create($data);

        $response = $this->post('/subcribirse/check_email', $data);
        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'exist' => true,
                ],
            ]);

        DB::rollback();
    }

    /** @test */
    public function email_not_exists()
    {
        $data = [
            "email" => "pacg1992@gmail.com",
        ];

        $response = $this->post('/subcribirse/check_email', $data);
        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'exist' => false,
                ],
            ]);
    }

    /** @test */
    public function validate_new_only_email()
    {
        $data = [
            "email" => "pacg1992@gmail.com",
        ];

        $response = $this->post('/subcribirse/new', $data);
        $response->assertStatus(302)->assertSessionHasErrors([
            'names' => 'El campo names es obligatorio.',
            'number' => 'El campo number es obligatorio.',
            'canal_marketing' => 'El campo canal marketing es obligatorio.',
        ]);
    }

    /** @test */
    public function new()
    {
        DB::beginTransaction();

        $data = [
            "email" => "pacg1992@gmail.com",
            "names" => "Pablo Contreras",
            "number" => "5646546",
            "canal_marketing" => "1",
        ];

        $response = $this->post('/subcribirse/new', $data);
        $response->assertStatus(200);

        DB::rollback();
    }

    /** @test */
    public function list()
    {
        $data = User::factory()->create();
        $data['password'] = 'password';

        $this->get('/login');
        $credentials = [
            'email' => $data['email'],
            "password" => $data['password'],
        ];
        $response = $this->post('/login', $credentials);
        $this->assertCredentials($credentials);

        $response = $this->get('/subcribirse/list');
        $response->assertStatus(200);
    }
}
