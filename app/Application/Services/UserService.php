<?php

namespace App\Application\Services;

use App\Domain\Models\User;

class UserService
{
    public static function increaseCredits(User $user, float $value): void
    {
        self::decreaseCredits($user, -$value);
    }

    public static function decreaseCredits(User $user, float $value): void
    {
        $user->credit -= $value;
        $user->save();
    }
}
