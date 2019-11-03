<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SampleControllerTest extends WebTestCase
{
    private $client;

    public function setUp(): void
    {
        $this->client = static::createClient();
    }

    public function testSomething()
    {
        $crawler = $this->client->request('GET', '/sample');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'SampleController');
    }

    public function testStatusCode()
    {
        $this->client->request('GET', '/sample');

        $this->assertResponseStatusCodeSame(200);
    }

    public function testRedirect()
    {
        $this->client->request('GET', '/jump');

        $this->assertResponseRedirects("/sample", 302);
    }

    public function testContactErrorMessage()
    {
        $crawler = $this->client->request("GET", "/contact");

        $form = $crawler->selectButton('Submit')->form();
        $this->client->submit($form);

        $this->assertResponseIsSuccessful();
    }

}
