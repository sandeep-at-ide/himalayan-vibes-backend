<?php

namespace App\Policies;

use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SiteSettingPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('view_any_site::setting');
    }

    public function view(User $user, SiteSetting $siteSetting): bool
    {
        return $user->can('view_site::setting');
    }

    public function create(User $user): bool
    {
        return $user->can('create_site::setting');
    }

    public function update(User $user, SiteSetting $siteSetting): bool
    {
        return $user->can('update_site::setting');
    }

    public function delete(User $user, SiteSetting $siteSetting): bool
    {
        return $user->can('delete_site::setting');
    }

    public function forceDelete(User $user, SiteSetting $siteSetting): bool
    {
        return $user->can('force_delete_site::setting');
    }

    public function restore(User $user, SiteSetting $siteSetting): bool
    {
        return $user->can('restore_site::setting');
    }

    public function replicate(User $user, SiteSetting $siteSetting): bool
    {
        return $user->can('replicate_site::setting');
    }
}
