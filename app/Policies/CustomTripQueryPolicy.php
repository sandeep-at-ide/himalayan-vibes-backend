<?php

namespace App\Policies;

use App\Models\CustomTripQuery;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomTripQueryPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('view_any_custom::trip::query');
    }

    public function view(User $user, CustomTripQuery $customTripQuery): bool
    {
        return $user->can('view_custom::trip::query');
    }

    public function create(User $user): bool
    {
        return $user->can('create_custom::trip::query');
    }

    public function update(User $user, CustomTripQuery $customTripQuery): bool
    {
        return $user->can('update_custom::trip::query');
    }

    public function delete(User $user, CustomTripQuery $customTripQuery): bool
    {
        return $user->can('delete_custom::trip::query');
    }

    public function forceDelete(User $user, CustomTripQuery $customTripQuery): bool
    {
        return $user->can('force_delete_custom::trip::query');
    }

    public function restore(User $user, CustomTripQuery $customTripQuery): bool
    {
        return $user->can('restore_custom::trip::query');
    }

    public function replicate(User $user, CustomTripQuery $customTripQuery): bool
    {
        return $user->can('replicate_custom::trip::query');
    }
}
