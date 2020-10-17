<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /**
     *
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     *
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager)
    {
        for($i=1; $i<=10; $i++)
        {
            $user = new User();
            $user->setPassword($this->encoder->encodePassword($user,"password"))
                ->setEmail(sprintf("email+%d@email.com", $i))
                ->setName(sprintf("name+%d", $i));
                $manager->persist($user);
        }
        $manager->flush();
    }
}
