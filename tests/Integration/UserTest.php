<?php
declare(strict_types=1);

namespace App\Tests\Integration;

use App\Entity\User;
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
     * @dataProvider provideUserGetData
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
     * @dataProvider provideUserGetData
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

    /**
     * @dataProvider provideUserStoreData
     */
    public function testCreate(array $expect, array $input): void
    {
        $user = new User(
            $input['email'],
            $input['password'],
            $input['name'],
            $input['surname'],
        );

        $user = $this->userRepository->store($user);

        self::assertEquals($expect['id'], $user->getId());
        self::assertEquals($expect['email'], $user->getEmail());
        self::assertEquals($expect['password'], $user->getPassword());
        self::assertEquals($expect['name'], $user->getName());
        self::assertEquals($expect['surname'], $user->getSurname());
        self::assertEquals($expect['createdAt'], $user->getCreatedAt()->toStringDate());
        self::assertEquals($expect['updatedAt'], $user->getUpdatedAt()?->toStringDate());
    }

    public function provideUserGetData(): array
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

    public function provideUserStoreData(): array
    {
        return [
            [
                [
                    'id' => 3,
                    'email' => 'user.creare@example.com',
                    'password' => '1234',
                    'name' => 'User',
                    'surname' => 'Create',
                    'createdAt' => DateTime::now()->toStringDate(),
                    'updatedAt' => null
                ],
                [
                    'email' => 'user.creare@example.com',
                    'password' => '1234',
                    'name' => 'User',
                    'surname' => 'Create',
                ],
            ],
        ];
    }
}