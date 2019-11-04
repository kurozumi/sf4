<?php

namespace App\Tests\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class UserControllerTest extends WebTestCase
{
    protected $client = null;

    protected $session;

    protected $entityManager;

    protected $router;

    public function setUp(): void
    {
        $this->client = static::createClient();
        $container = $this->client->getContainer();

        $this->session = $this->client->getContainer()->get('session');
        $this->entityManager = $container->get('doctrine')->getManager();
        $this->router = $container->get('router');
    }

    public function testLoginSuccess()
    {
        $this->logIn();
        $crawler = $this->client->request('GET', $this->generateUrl("user_index"));

        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $this->assertSame("User Page", $crawler->filter("h1")->text());
    }

    protected function logIn()
    {
        $firewallName = 'main';

        $firewallContext = "main";

        $user = $this->entityManager
            ->getRepository(User::class)->find(1);

        $token = new UsernamePasswordToken($user, null, $firewallName, ["ROLE_USER"]);

        $this->session->set('_security_' . $firewallContext, serialize($token));
        $this->session->save();

        $cookie = new Cookie($this->session->getName(), $this->session->getId());
        $this->client->getCookieJar()->set($cookie);
    }

    protected function generateUrl($route, $parameters = [], $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH)
    {
        return $this->router->generate($route, $parameters, $referenceType);
    }
}
