<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\ApiUser;
use App\Models\User;

class UserTest extends TestCase
{

    public function testsUsersAreCreatedCorrectly()
    {
        $api_user = ApiUser::factory()->create();
        $this->actingAs($api_user, 'api');
        $accessToken = $api_user->createToken('authToken')->accessToken;
        $headers = ['Authorization' => "Bearer $accessToken"];
        $payload = [
            'name'    => 'Lorem',
            'email'   => 'Ipsum@example.com',
            'age'     =>  21,
            'address' => 'Ipsum',
        ];

        $this->json('POST', '/api/users', $payload, $headers)->assertStatus(200);
    }

    public function testsScoreAreIncrementedCorrectly()
    {
        $user = ApiUser::factory()->create();
        $token = $user->createToken('authToken')->accessToken;
        $headers = ['Authorization' => "Bearer $token"];
        $user = User::factory()->create([
            'name'    => 'Lorem',
            'email'   => 'testing@example.com',
            'age'     =>  21,
            'address' => 'Ipsum',
        ]);


        $response = $this->json('POST', '/api/add-score/' . $user->id,[], $headers)
            ->assertStatus(200);
    }

    public function testsScoreAreDecrementedCorrectly()
    {
        $user = ApiUser::factory()->create();
        $token = $user->createToken('authToken')->accessToken;
        $headers = ['Authorization' => "Bearer $token"];
        $user = User::factory()->create([
            'name'    => 'Lorem',
            'email'   => 'testing@example.com',
            'age'     =>  21,
            'address' => 'Ipsum',
        ]);

        $this->json('POST', '/api/add-score/' . $user->id, [], $headers)->assertStatus(200);
        $this->json('POST', '/api/delete-score/' . $user->id, [], $headers)->assertStatus(200);
    }

    public function testsUsersAreDeletedCorrectly()
    {
        $api_user = ApiUser::factory()->create();
        $token = $api_user->createToken('authToken')->accessToken;
        $headers = ['Authorization' => "Bearer $token"];
        $user = User::factory()->create([
            'name'    => 'Lorem',
            'email'   => 'Ipsum@example.com',
            'age'     => 20,
            'address' => 'Ipsum',
        ]);

        $this->json('DELETE', '/api/users/' . $user->id, [], $headers)->assertStatus(200);
    }

    public function testUsersAreListedCorrectly()
    {
        User::factory()->create([
            'name'    => 'Lorem',
            'email'   => 'Ipsum2@example.com',
            'age'     => 'Ipsum',
            'address' => 'Ipsum',
        ]);

        User::factory()->create([
            'name'    => 'Lorem',
            'email'   => 'Ipsum1@example.com',
            'age'     => 'Ipsum',
            'address' => 'Ipsum',
        ]);

        $api_user = ApiUser::factory()->create();
        $token = $api_user->createToken('authToken')->accessToken;
        $headers = ['Authorization' => "Bearer $token"];

        $response = $this->json('GET', '/api/users', [], $headers)->assertStatus(200);
    }

}
