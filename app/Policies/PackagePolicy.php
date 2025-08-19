<?php

namespace App\Policies;

use App\Models\Package;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PackagePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('view_any_package');
    }

    public function view(User $user, Package $package): bool
    {
        return $user->can('view_package');
    }

    public function create(User $user): bool
    {
        return $user->can('create_package');
    }

    public function update(User $user, Package $package): bool
    {
        return $user->can('update_package');
    }

    public function delete(User $user, Package $package): bool
    {
        return $user->can('delete_package');
    }

    public function forceDelete(User $user, Package $package): bool
    {
        return $user->can('force_delete_package');
    }

    public function restore(User $user, Package $package): bool
    {
        return $user->can('restore_package');
    }

    public function replicate(User $user, Package $package): bool
    {
        return $user->can('replicate_package');
    }
}
