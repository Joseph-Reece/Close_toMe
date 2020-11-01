<?php

namespace Tests\Feature;

use App\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    /* public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        $response = $this->get('/');

        $response->dumpHeaders();

        $response->dumpSession();

        $response->dump();

    } */

    public function testApplication()
    {
        $user = factory(App\User::class)->create();

        $response = $this->actingAs($user)
            ->withSession(['foo' => 'bar'])
            ->get('/');
        $this->assertTrue($response['created']);
    }

    public function testClient()
    {
        $user = factory(App\Client::class)->create();

        $response = $this->actingAs($user, 'client')
            ->withSession(['foo' => 'bar'])
            ->get('/');
        $this->assertTrue($response['created']);

    }

}
