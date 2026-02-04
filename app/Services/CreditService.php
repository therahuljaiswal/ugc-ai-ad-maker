<?php

namespace App\Services;

use App\Models\User;

class CreditService
{
    public const VIDEO_COST = 10;
    public const IMAGE_COST = 5;

    public function hasCredits(User $user, int $amount): bool
    {
        return $user->credits >= $amount;
    }

    public function deductCredits(User $user, int $amount): bool
    {
        if (!$this->hasCredits($user, $amount)) {
            return false;
        }

        $user->decrement('credits', $amount);
        return true;
    }

    public function addCredits(User $user, int $amount): void
    {
        $user->increment('credits', $amount);
    }
}
