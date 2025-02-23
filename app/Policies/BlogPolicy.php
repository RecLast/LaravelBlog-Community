<?php

namespace App\Policies;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlogPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Blog $blog)
    {
        return $user->id === $blog->user_id;
    }

    public function delete(User $user, Blog $blog)
    {
        return $user->id === $blog->user_id;
    }
}