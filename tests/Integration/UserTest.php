<?php
declare(strict_types=1);

namespace App\Tests\Integration;

use App\Repository\UserRepository;
use App\Utils\DateTime;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserTest extends KernelTestCase
{
    private UserRepository $userRepository;

    protected function setUp(): void
    {
        // (1) boot the Symfony kernel
        self::bootKernel();
        // (2) use static::getContainer() to access the service container
        $container = static::getContainer();
        // (3) run some service & test the result
        $this->userRepository = $container->get(UserRepository::class);
    }

    /**
     * @dataProvider provideUserData
     */
    public function testGet(
        int $id,
        string $email,
        string $password,
        string $name,
        string $surname,
        string $createdAt,
        ?string $updatedAt,
    ): void {
        $user = $this->userRepository->get($id);

        self::assertEquals($id, $user->getId());
        self::assertEquals($email, $user->getEmail());
        self::assertEquals($password, $user->getPassword());
        self::assertEquals($name, $user->getName());
        self::assertEquals($surname, $user->getSurname());
        self::assertEquals($createdAt, $user->getCreatedAt()->toStringDate());
        self::assertEquals($updatedAt, $user->getUpdatedAt()?->toStringDate());
    }

    /**
     * @dataProvider provideUserData
     */
    public function testGetByEmail(
        int $id,
        string $email,
        string $password,
        string $name,
        string $surname,
        string $createdAt,
        ?string $updatedAt,
    ): void {
        $user = $this->userRepository->getByEmail($email);

        self::assertEquals($id, $user->getId());
        self::assertEquals($email, $user->getEmail());
        self::assertEquals($password, $user->getPassword());
        self::assertEquals($name, $user->getName());
        self::assertEquals($surname, $user->getSurname());
        self::assertEquals($createdAt, $user->getCreatedAt()->toStringDate());
        self::assertEquals($updatedAt, $user->getUpdatedAt()?->toStringDate());
    }

    public function provideUserData(): array
    {
        return [
            [
                'id' => 1,
                'email' => 'john.doe@example.com',
                'password' => '1234',
                'name' => 'John',
                'surname' => 'Doe',
                'createdAt' => DateTime::now()->toStringDate(),
                'updatedAt' => null
            ],
            [
                'id' => 2,
                'email' => 'jan.novak@example.com',
                'password' => '123456',
                'name' => 'Jan',
                'surname' => 'Novak',
                'createdAt' => DateTime::now()->toStringDate(),
                'updatedAt' => null
            ],
        ];
    }
}