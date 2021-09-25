<?php
declare(strict_types=1);

namespace App\Tests\Integration;

use App\Repository\UserRepository;
use App\Tests\Integration\Attribute\ContainerTrait;
use App\Utils\DateTime;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserTest extends KernelTestCase
{
    use ContainerTrait;

    private UserRepository $userRepository;

    protected function setUp(): void
    {
        $container = $this->getContainerForTest();

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
}