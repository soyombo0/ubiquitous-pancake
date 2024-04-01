<?php

namespace App\Domain\Observers;

use App\Domain\Models\User;

class UserObserver
{
    public function creating(User $user): void
    {
        $user->credit = 5000000;
    }
}
