<?php

namespace App\Policies;

use App\Models\Destination;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DestinationPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('view_any_destination');
    }

    public function view(User $user, Destination $destination): bool
    {
        return $user->can('view_destination');
    }

    public function create(User $user): bool
    {
        return $user->can('create_destination');
    }

    public function update(User $user, Destination $destination): bool
    {
        return $user->can('update_destination');
    }

    public function delete(User $user, Destination $destination): bool
    {
        return $user->can('delete_destination');
    }

    public function forceDelete(User $user, Destination $destination): bool
    {
        return $user->can('force_delete_destination');
    }

    public function restore(User $user, Destination $destination): bool
    {
        return $user->can('restore_destination');
    }

    public function replicate(User $user, Destination $destination): bool
    {
        return $user->can('replicate_destination');
    }
}
