<?php

namespace App\Policies;

use App\Models\ContactMessage;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContactMessagePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('view_any_contact::message');
    }

    public function view(User $user, ContactMessage $contactMessage): bool
    {
        return $user->can('view_contact::message');
    }

    public function create(User $user): bool
    {
        return $user->can('create_contact::message');
    }

    public function update(User $user, ContactMessage $contactMessage): bool
    {
        return $user->can('update_contact::message');
    }

    public function delete(User $user, ContactMessage $contactMessage): bool
    {
        return $user->can('delete_contact::message');
    }

    public function forceDelete(User $user, ContactMessage $contactMessage): bool
    {
        return $user->can('force_delete_contact::message');
    }

    public function restore(User $user, ContactMessage $contactMessage): bool
    {
        return $user->can('restore_contact::message');
    }

    public function replicate(User $user, ContactMessage $contactMessage): bool
    {
        return $user->can('replicate_contact::message');
    }
}
