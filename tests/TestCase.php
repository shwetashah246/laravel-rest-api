<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Artisan;
use Laravel\Passport\ClientRepository;
use DB;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseMigrations;

    protected $client = [];

    public function setUp() : void
    {
        parent::setUp();
        Artisan::call('db:seed');
        //$this->artisan('passport:install');

        $clientRepository = new ClientRepository();
        $this->client = $clientRepository->createPersonalAccessClient(
            null, 'Test Personal Access Client', 'http://localhost'
        );

        DB::table('oauth_personal_access_clients')->insert([
            'client_id' => $this->client->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }

}
