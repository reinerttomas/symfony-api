<?php
declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public const USER_1 = 'user.1';
    public const USER_2 = 'user.2';

    public function load(ObjectManager $manager): void
    {
        $user1 = $this->createUser(
            'john.doe@example.com',
            '1234',
            'John',
            'Doe',
        );

        $user2 = $this->createUser(
            'jan.novak@example.com',
            '123456',
            'Jan',
            'Novak',
        );

        $manager->persist($user1);
        $manager->persist($user2);
        $manager->flush();

        $this->addReference(self::USER_1, $user1);
        $this->addReference(self::USER_2, $user2);
    }

    private function createUser(
        string $email,
        string $password,
        string $name,
        string $surname
    ): User {
        return new User(
            $email,
            $password,
            $name,
            $surname,
        );
    }
}