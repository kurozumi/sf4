<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

class UserFixture extends Fixture
{
    /**
     * @var PasswordEncoderInterface
     */
    private $passwordEncoder;

//    public function __construct(
//        PasswordEncoderInterface $passwordEncoder
//    ){
//        $this->passwordEncoder = $passwordEncoder;
//    }

    public function load(ObjectManager $manager)
    {
//        $password = $this->passwordEncoder->encodePassword("password");
//
//        $user = new User();
//        $user->setUsername("user");
//        $user->getPassword($password);
//        $user->setRoles(["ROLE_USER"]);
//
//        $manager->persist($user);
//        $manager->flush();
    }
}
