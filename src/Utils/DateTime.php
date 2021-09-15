<?php
declare(strict_types=1);

namespace App\Utils;

use DateTimeInterface;
use DateTime as PhpDateTime;
use Nette\Utils\DateTime as NetteDateTime;

final class DateTime extends NetteDateTime
{
    private const FORMAT_DEFAULT_DATE = 'Y-m-d';
    private const FORMAT_DEFAULT_DATETIME = 'Y-m-d H:i:s';
    private const FORMAT_DEFAULT_DATETIME_WITH_MICROSECONDS = 'Y-m-d H:i:s';

    public static function fromPhpDateTime(DateTimeInterface $dateTime): DateTime
    {
        return new DateTime($dateTime->format(self::FORMAT_DEFAULT_DATETIME_WITH_MICROSECONDS));
    }

    public static function fromPhpDateTimeOrNull(?PhpDateTime $dateTime = null): ?DateTime
    {
        if ($dateTime === null) {
            return null;
        }

        return new DateTime($dateTime->format(self::FORMAT_DEFAULT_DATETIME_WITH_MICROSECONDS));
    }

    public function toStringDate(): string
    {
        return $this->format(self::FORMAT_DEFAULT_DATE);
    }

    public function toStringDateTime(): string
    {
        return $this->format(self::FORMAT_DEFAULT_DATETIME);
    }

    public function toStringDateTimeWithMicroseconds(): string
    {
        return $this->format(self::FORMAT_DEFAULT_DATETIME_WITH_MICROSECONDS);
    }

    public function __toString(): string
    {
        return $this->toStringDateTime();
    }
}