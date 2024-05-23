<?php

declare(strict_types=1);

namespace App\Enums;

enum RoomStatusEnum: string
{
    case Available = 'available';
    case Booked = 'booked';
    case Occupied = 'occupied';

    public function  label(): string
    {
        return match($this) {
            self::Available => 'Свободен',
            self::Booked => 'Забронирован',
            self::Occupied => 'Заселен',
        };
    }
}
