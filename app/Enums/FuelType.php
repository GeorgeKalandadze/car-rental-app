<?php

namespace App\Enums;

enum FuelType: string
{
    case PETROL = 'Petrol';
    case DIESEL = 'Diesel';
    case ELECTRIC = 'Electric';

    public static function toArray(): array
    {
        return [
            self::PETROL,
            self::DIESEL,
            self::ELECTRIC,
        ];
    }
}
