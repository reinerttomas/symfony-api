<?php
declare(strict_types=1);

namespace App\Database\Type;

use App\Utils\DateTime;
use DateTime as PhpDateTime;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\DateType as DoctrineDateType;

final class DateType extends DoctrineDateType
{
    private const NAME = 'date';

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return $platform->getDateTimeTypeDeclarationSQL($column);
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?DateTime
    {
        if ($value === null || $value instanceof DateTime) {
            return $value;
        }

        $dateMutable = PhpDateTime::createFromFormat($platform->getDateFormatString(), $value);

        if ($dateMutable !== false) {
            $val = DateTime::fromPhpDateTime($dateMutable);
        } else {
            $val = new DateTime((string)$value);
        }

        return $val->setTime(0, 0, 0, 0);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if ($value !== null) {
            return $value->format($platform->getDateFormatString());
        }

        return null;
    }

    public function getName(): string
    {
        return self::NAME;
    }
}