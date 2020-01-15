<?php

namespace App\tests\Controller;

use App\Tests\DataFixtureTestCase;

class SecurityControllerTest extends DataFixtureTestCase
{
    public function testRequiresAuthenticationForAccessApi()
    {
        $client = static::createClient();
        $client->request('GET', '/api/brand');

        $this->assertSame(401, $client->getResponse()->getStatusCode());
    }

    public function testBadGetUserToken()
    {
        $response = $this->post('/api/login_check', [
            'username' => 'admin1',
            'password' => 'admin1',
        ], true);

        $this->assertSame(401, $response->getStatusCode());

        $responseArray = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('code', $responseArray);
        $this->assertArrayHasKey('message', $responseArray);
    }

    public function testSuccessfullyGetUserToken()
    {
        $response = $this->post('/api/login_check', [
            'username' => 'admin',
            'password' => 'admin',
        ], true);

        $this->assertSame(200, $response->getStatusCode());

        $responseArray = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('token', $responseArray);
    }
}
