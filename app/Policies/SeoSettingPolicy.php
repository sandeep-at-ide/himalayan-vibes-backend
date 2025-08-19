<?php

namespace App\Policies;

use App\Models\SeoSetting;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SeoSettingPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('view_any_seo::setting');
    }

    public function view(User $user, SeoSetting $seoSetting): bool
    {
        return $user->can('view_seo::setting');
    }

    public function create(User $user): bool
    {
        return $user->can('create_seo::setting');
    }

    public function update(User $user, SeoSetting $seoSetting): bool
    {
        return $user->can('update_seo::setting');
    }

    public function delete(User $user, SeoSetting $seoSetting): bool
    {
        return $user->can('delete_seo::setting');
    }

    public function forceDelete(User $user, SeoSetting $seoSetting): bool
    {
        return $user->can('force_delete_seo::setting');
    }

    public function restore(User $user, SeoSetting $seoSetting): bool
    {
        return $user->can('restore_seo::setting');
    }

    public function replicate(User $user, SeoSetting $seoSetting): bool
    {
        return $user->can('replicate_seo::setting');
    }
}
