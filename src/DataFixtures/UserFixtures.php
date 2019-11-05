<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    public const USERNAME = "username";

    public const PASSWORD = "password";

    public const ROLES = ["ROLE_USER"];

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(
        UserPasswordEncoderInterface $passwordEncoder
    ) {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername(self::USERNAME);
        $user->setRoles(self::ROLES);

        $password = $this->passwordEncoder->encodePassword($user, self::PASSWORD);
        $user->setPassword($password);

        $manager->persist($user);
        $manager->flush();
    }
}
