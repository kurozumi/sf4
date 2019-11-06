<?php


namespace App\Tests\Controller;


use App\DataFixtures\UserFixtures;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class AbstractWebTestCase extends WebTestCase
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

    protected function generateUrl($route, $parameters = [], $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH)
    {
        return $this->router->generate($route, $parameters, $referenceType);
    }

    protected function logIn()
    {
        $firewallName = 'main';

        $firewallContext = "main";

        $user = $this->entityManager
            ->getRepository(User::class)->findOneBy(["username" => UserFixtures::USERNAME]);

        if($user instanceof User) {
            $token = new UsernamePasswordToken($user, null, $firewallName, UserFixtures::ROLES);

            $this->session->set('_security_' . $firewallContext, serialize($token));
            $this->session->save();

            $cookie = new Cookie($this->session->getName(), $this->session->getId());
            $this->client->getCookieJar()->set($cookie);
        }
    }
}