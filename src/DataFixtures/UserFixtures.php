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
        $user->setPassword('$2y$13$6/GhQGIEoZI7iRIWdDPCWu9JuzeGO0n0e3jBhVgZisX91p7w995WK');

        $manager->persist($user);

        $admin = new User();
        $admin->setUsername('admin');
        $admin->setPassword('$2y$13$20MWAWDfkk8BX9xACEeqQepdBh51MM1iPe5MJMoEb2z2gC1chUhDO');
        $admin->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);

        $manager->flush();
    }
}
