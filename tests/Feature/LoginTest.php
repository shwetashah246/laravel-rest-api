<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\ApiUser;

class LoginTest extends TestCase
{

    use RefreshDatabase;

    public function testRequiresEmailAndLogin()
    {
        $this->json('POST', 'api/login')
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'email' => ['The email field is required.'],
                    'password' => ['The password field is required.'],
                ]
            ]);
    }


    public function testUserLoginsSuccessfully()
    {
        $api_user = ApiUser::factory()->create();
        $this->actingAs($api_user, 'api');

        $payload = ['email' => $api_user->email, 'password' => 'password'];

        $accessToken = $api_user->createToken('authToken')->accessToken;
            
        $this->json('POST', 'api/login', $payload)->assertStatus(200);
    }
}
