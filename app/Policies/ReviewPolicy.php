<?php

namespace App\Policies;

use App\Models\Review;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReviewPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('view_any_review');
    }

    public function view(User $user, Review $review): bool
    {
        return $user->can('view_review');
    }

    public function create(User $user): bool
    {
        return $user->can('create_review');
    }

    public function update(User $user, Review $review): bool
    {
        return $user->can('update_review');
    }

    public function delete(User $user, Review $review): bool
    {
        return $user->can('delete_review');
    }

    public function forceDelete(User $user, Review $review): bool
    {
        return $user->can('force_delete_review');
    }

    public function restore(User $user, Review $review): bool
    {
        return $user->can('restore_review');
    }

    public function replicate(User $user, Review $review): bool
    {
        return $user->can('replicate_review');
    }
}
