<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    public function testsRegistersSuccessfully()
    {
        $payload = [
            'name' => 'test',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $this->json('post', '/api/register', $payload)->assertStatus(200);
    }

    public function testsRequiresPasswordEmailAndName()
    {
        $this->json('post', '/api/register')->assertStatus(422);
    }

    public function testsRequirePasswordConfirmation()
    {
        $payload = [
            'name' => 'test',
            'email' => 'test@example.com',
            'password' => 'password',
        ];

        $this->json('post', '/api/register', $payload)->assertStatus(422);
    }

}
