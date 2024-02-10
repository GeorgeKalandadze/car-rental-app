<?php

namespace App\Enums;

enum Condition: string
{
    const NEW = 'new';
    const USED = 'used';

    public static function toArray(): array
    {
        return [
            self::NEW,
            self::USED
        ];
    }
}
