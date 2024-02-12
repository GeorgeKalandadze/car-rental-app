<?php

namespace App\Enums;

enum FuelType: string
{
    case PETROL = 'Petrol';
    case DIESEL = 'Diesel';
    case ELECTRIC = 'Electric';
    case GASOLINE = 'Gasoline';

    public static function toArray(): array
    {
        return [
            self::PETROL,
            self::DIESEL,
            self::ELECTRIC,
            self::GASOLINE,
        ];
    }
}
