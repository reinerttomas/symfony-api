<?php
declare(strict_types=1);

namespace App\Tests\Integration\Attribute;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @mixin KernelTestCase
 */
trait ContainerTrait
{
    protected function getContainerForTest(): ContainerInterface
    {
        // (1) boot the Symfony kernel
        self::bootKernel();
        // (2) use static::getContainer() to access the service container
        return static::getContainer();
    }
}