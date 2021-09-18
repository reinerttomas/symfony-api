<?php
declare(strict_types=1);

namespace App\Utils;

use App\Exception\Exception;
use DateTimeInterface;
use Exception as PhpException;
use Nette\Utils\DateTime as NetteDateTime;

final class DateTime extends NetteDateTime
{
    private const FORMAT_DEFAULT_DATE = 'Y-m-d';
    private const FORMAT_DEFAULT_DATETIME = 'Y-m-d H:i:s';

    public static function now(): DateTime
    {
        try {
            return new DateTime();
        } catch (PhpException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function fromPhpDateTime(DateTimeInterface $dateTime): DateTime
    {
        try {
            return self::from($dateTime);
        } catch (PhpException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function fromPhpDateTimeOrNull(?DateTimeInterface $dateTime = null): ?DateTime
    {
        if ($dateTime === null) {
            return null;
        }

        return self::fromPhpDateTime($dateTime);
    }

    public function toStringDate(): string
    {
        return $this->format(self::FORMAT_DEFAULT_DATE);
    }

    public function toStringDateTime(): string
    {
        return $this->format(self::FORMAT_DEFAULT_DATETIME);
    }

    public function __toString(): string
    {
        return $this->toStringDateTime();
    }
}