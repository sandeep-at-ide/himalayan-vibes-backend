<?php

namespace App\Policies;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlogPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('view_any_blog');
    }

    public function view(User $user, Blog $blog): bool
    {
        return $user->can('view_blog');
    }

    public function create(User $user): bool
    {
        return $user->can('create_blog');
    }

    public function update(User $user, Blog $blog): bool
    {
        return $user->can('update_blog');
    }

    public function delete(User $user, Blog $blog): bool
    {
        return $user->can('delete_blog');
    }

    public function forceDelete(User $user, Blog $blog): bool
    {
        return $user->can('force_delete_blog');
    }

    public function restore(User $user, Blog $blog): bool
    {
        return $user->can('restore_blog');
    }

    public function replicate(User $user, Blog $blog): bool
    {
        return $user->can('replicate_blog');
    }
}
