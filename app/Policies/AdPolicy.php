<?php

namespace App\Policies;

use App\Models\Ad;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AdPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Ad $ad): bool
    {
        return $user->id === $ad->user_id || $user->is_admin;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Ad $ad): bool
    {
        return $user->id === $ad->user_id || $user->is_admin;
    }
}
