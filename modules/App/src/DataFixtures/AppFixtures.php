<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class AppFixtures.
 */
class AppFixtures extends Fixture
{
    /**
     * @var PasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $this->loadUsers($manager);
    }

    private function loadUsers(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('admin');
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'admin'));
        $user->setActive(true);

        $manager->persist($user);
        $manager->flush();
    }
}
