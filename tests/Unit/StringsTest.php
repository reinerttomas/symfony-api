<?php
declare(strict_types=1);

namespace App\Tests\Unit;

use App\Utils\Strings;
use PHPUnit\Framework\TestCase;

class StringsTest extends TestCase
{
    /**
     * @dataProvider provideTrimData
     */
    public function testTrim(string $expect, string $input): void
    {
        self::assertEquals($expect, Strings::trim($input));
    }

    /**
     * @dataProvider provideWebalizeData
     */
    public function testWebalize(string $expect, string $input): void
    {
        self::assertEquals($expect, Strings::webalize($input));
    }

    /**
     * @dataProvider provideCapitalizeData
     */
    public function testCapitalize(string $expect, string $input): void
    {
        self::assertEquals($expect, Strings::capitalize($input));
    }

    /**
     * @dataProvider provideLowerData
     */
    public function testLower(string $expect, string $input): void
    {
        self::assertEquals($expect, Strings::lower($input));
    }

    /**
     * @dataProvider provideUpperData
     */
    public function testUpper(string $expect, string $input): void
    {
        self::assertEquals($expect, Strings::upper($input));
    }

    public function provideTrimData(): array
    {
        return [
            [
                'Hello World',
                ' Hello World',
            ],
            [
                'Hello World',
                " Hello World \n",
            ],
        ];
    }

    public function provideWebalizeData(): array
    {
        return [
            [
                'hello-world',
                ' Hello World!',
            ],
            [
                'prilis-zlutoucky-kun-upel-dabelske-ody',
                'Příliš žluťoučký kůň úpěl ďábelské ódy!',
            ],
        ];
    }

    public function provideCapitalizeData(): array
    {
        return [
            [
                'Hello World',
                'hello world',
            ],
            [
                'Příliš Žluťoučký Kůň Úpěl Ďábelské Ódy!',
                'Příliš žluťoučký kůň úpěl ďábelské ódy!',
            ],
        ];
    }

    public function provideLowerData(): array
    {
        return [
            [
                'hello world',
                'Hello World',
            ],
        ];
    }

    public function provideUpperData(): array
    {
        return [
            [
                'HELLO WORLD',
                'Hello World',
            ],
        ];
    }
}