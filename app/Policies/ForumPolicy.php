<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Forum;
use Illuminate\Auth\Access\HandlesAuthorization;

class ForumPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true; // You can modify this based on your requirements
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Forum $forum): bool
    {
        return $user->id === $forum->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Forum $forum): bool
    {
        return $user->id === $forum->user_id;
    }
}