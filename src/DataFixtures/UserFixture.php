<?php

namespace App\DataFixtures;

use App\Entity\AppUsers;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserFixture extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
       $user = new AppUsers();
       $user->setUsername('admin@gavan.pro');
       $user->setRealName('Ксения Ибрагимова');
       $user->setRoles('ROLE_ADMIN');
       $user->setPassword(
           $this->encoder->encodePassword($user, 'admingavan!')
       );
       $manager->persist($user);


        $manager->flush();
    }
}
