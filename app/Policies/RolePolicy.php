<?php
namespace App\Policies;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Check if the user is a super admin or has the 'view_any_role' permission
        return $user->hasRole('super_admin') || $user->can('view_any_role');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Role $role): bool
    {
        // Check if the user is a super admin or has the 'view_role' permission
        return $user->hasRole('super_admin') || $user->can('view_role');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Check if the user is a super admin or has the 'create_role' permission
        return $user->hasRole('super_admin') || $user->can('create_role');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Role $role): bool
    {
        // Check if the user is a super admin or has the 'update_role' permission
        return $user->hasRole('super_admin') || $user->can('update_role');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Role $role): bool
    {
        // Check if the user is a super admin or has the 'delete_role' permission
        return $user->hasRole('super_admin') || $user->can('delete_role');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        // Check if the user is a super admin or has the 'delete_any_role' permission
        return $user->hasRole('super_admin') || $user->can('delete_any_role');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, Role $role): bool
    {
        // Check if the user is a super admin or has the 'ForceDelete' permission
        return $user->hasRole('super_admin') || $user->can('ForceDelete');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        // Check if the user is a super admin or has the 'ForceDeleteAny' permission
        return $user->hasRole('super_admin') || $user->can('ForceDeleteAny');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, Role $role): bool
    {
        // Check if the user is a super admin or has the 'Restore' permission
        return $user->hasRole('super_admin') || $user->can('Restore');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        // Check if the user is a super admin or has the 'RestoreAny' permission
        return $user->hasRole('super_admin') || $user->can('RestoreAny');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, Role $role): bool
    {
        // Check if the user is a super admin or has the 'Replicate' permission
        return $user->hasRole('super_admin') || $user->can('Replicate');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        // Check if the user is a super admin or has the 'Reorder' permission
        return $user->hasRole('super_admin') || $user->can('Reorder');
    }
}
