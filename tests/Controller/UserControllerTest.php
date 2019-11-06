<?php

namespace App\Tests\Controller;

use Symfony\Component\HttpFoundation\Response;

class UserControllerTest extends BaseWebTestCase
{
    public function testLoginSuccess()
    {
        $this->logIn();
        $crawler = $this->client->request('GET', $this->generateUrl("user_index"));

        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $this->assertSame("User Page", $crawler->filter("h1")->text());
    }
}
