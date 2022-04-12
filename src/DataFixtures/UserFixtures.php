<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('paul');
        $user->setPassword('$2y$13$7HwYbRO/amS1qYc7Y5ZE/OLGj.mc4FcE1VdPMPsjmCrtiD5eFykaG');

        $manager->persist($user);

        $admin = new User();
        $admin->setUsername('admin');
        $admin->setPassword('$2y$13$bcHZ.9LYWaoaUqaERzy.Bur0jmBqo.NKuxgSVg/DjNDJ6yafTfeZ.');
        $admin->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);

        $manager->flush();
    }
}
