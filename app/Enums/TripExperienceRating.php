<?php

namespace App\Enums;

enum TripExperienceRating: int
{
    case OneStar = 1;
    case TwoStars = 2;
    case ThreeStars = 3;
    case FourStars = 4;
    case FiveStars = 5;

    public static function options(): array
    {
        return [
            self::OneStar->value => 'Very Dissatisfied',
            self::TwoStars->value => 'Dissatisfied',
            self::ThreeStars->value => 'Neutral',
            self::FourStars->value => 'Satisfied',
            self::FiveStars->value => 'Very Satisfied',
        ];
    }
    public function label(): string
    {
        return self::options()[$this->value] ?? 'Unknown';
    }
}
