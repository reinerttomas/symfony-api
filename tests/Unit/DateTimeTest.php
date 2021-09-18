<?php
declare(strict_types=1);

namespace App\Tests\Unit;

use App\Utils\DateTime;
use DateTime as PhpDateTime;
use PHPUnit\Framework\TestCase;

class DateTimeTest extends TestCase
{
    /**
     * @dataProvider provideToStringData
     */
    public function testToString(
        string $input,
        string $toStringDate,
        string $toStringDateTime,
    ): void {
        $dataTime = new DateTime($input);

        self::assertEquals($toStringDate, $dataTime->toStringDate());
        self::assertEquals($toStringDateTime, $dataTime->toStringDateTime());
    }

    /**
     * @dataProvider providePhpDateTime
     */
    public function testFromPhpDateTimeWithThrowable(string $string): void
    {
        $phpDateTime = new PhpDateTime($string);
        $dateTime = DateTime::fromPhpDateTime($phpDateTime);

        self::assertEquals($string, $dateTime->toStringDateTime());
    }

    public function provideToStringData(): array
    {
        return [
            [
                'input' => '2021-01-01 08:10:59',
                'toStringDate' => '2021-01-01',
                'toStringDateTime' => '2021-01-01 08:10:59',
            ],
            [
                'input' => '2021-01-02 15:40:33',
                'toStringDate' => '2021-01-02',
                'toStringDateTime' => '2021-01-02 15:40:33',
            ]
        ];
    }

    public function providePhpDateTime(): array
    {
        return [
            [
                '2021-01-01 08:10:59'
            ],
            [
                '2021-01-02 15:40:33'
            ],
        ];
    }
}