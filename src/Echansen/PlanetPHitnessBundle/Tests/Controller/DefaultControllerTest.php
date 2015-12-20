<?php

namespace Echansen\PlanetPHitnessBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UsersControllerTest extends WebTestCase
{
    private function createRequest($httpMethod, $uri)
    {
        $client = static::createClient();

        $client->request($httpMethod, $uri);

        return [$client->getRequest(), $client->getResponse()];
    }

    public function testSalt()
    {
        list($request, $response) = $this->createRequest('GET', '/users/salt');

        $this->assertNotEquals('application/json', $response->headers->get('Content-Type'));
        $this->assertNotEquals(200, $response->getStatusCode());

        list($request, $response) = $this->createRequest('GET', '/users/salt/1');

        $salt = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('salt', $salt);
        $this->assertNotEquals('', $salt['salt']);
    }
}
