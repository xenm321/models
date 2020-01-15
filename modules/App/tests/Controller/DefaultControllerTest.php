<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testCanSeeIndexPage()
    {
        $client = static::createClient();

        $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testIndexPageContainsOneWithIdAppDiv()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertCount(1, $crawler->filter('div#app'));
    }
}
