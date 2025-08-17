<?php

namespace App\Enums;

enum Status: string
{
    case Pending = 'pending';
    case Reviewed = 'reviewed';
    case Approved = 'approved';
    case Rejected = 'rejected';
    case Replied = 'replied';

    public static function options(): array
    {
        return [
            self::Pending->value => 'Pending',
            self::Reviewed->value => 'Reviewed',
            self::Approved->value => 'Approved',
            self::Rejected->value => 'Rejected',
            self::Replied->value => 'Replied',
        ];
    }
}
