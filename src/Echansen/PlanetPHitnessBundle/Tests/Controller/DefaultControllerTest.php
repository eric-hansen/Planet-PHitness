<?php

namespace Echansen\PlanetPHitnessBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UsersControllerTest extends WebTestCase
{
    public function testSalt()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/users/salt');

        $contentType = $client->getResponse()->headers->get('Content-Type');

        $this->assertEquals('application/json', $contentType);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $salt = json_decode($client->getResponse()->getContent(), true);

        $this->assertArrayHasKey('salt', $salt);
        $this->assertNotEquals('', $salt['salt']);
    }
}
