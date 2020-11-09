<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\ApiUser;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    public function testUserIsLoggedOutProperly()
    {
        $api_user = ApiUser::factory()->create();
        $this->actingAs($api_user, 'api');

        $accessToken = $api_user->createToken('authToken')->accessToken;
        $headers = ['Authorization' => "Bearer $accessToken"];

        $this->json('get', '/api/users', [], $headers)->assertStatus(200);
        $this->json('post', '/api/logout', [], $headers)->assertStatus(200);
    }

}
