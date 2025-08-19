<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Payment;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any payments.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_payment');
    }

    /**
     * Determine whether the user can view a specific payment.
     */
    public function view(User $user, Payment $payment): bool
    {
        return $user->can('view_payment');
    }

    /**
     * Determine whether the user can create payments.
     */
    public function create(User $user): bool
    {
        return $user->can('create_payment');
    }

    /**
     * Determine whether the user can update the payment.
     */
    public function update(User $user, Payment $payment): bool
    {
        return $user->can('update_payment');
    }

    /**
     * Determine whether the user can delete the payment.
     */
    public function delete(User $user, Payment $payment): bool
    {
        return $user->can('delete_payment');
    }

    /**
     * Determine whether the user can bulk delete payments.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_payment');
    }

    /**
     * Determine whether the user can permanently delete a payment.
     */
    public function forceDelete(User $user, Payment $payment): bool
    {
        return $user->can('force_delete_payment');
    }

    /**
     * Determine whether the user can bulk permanently delete payments.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_payment');
    }

    /**
     * Determine whether the user can restore a payment.
     */
    public function restore(User $user, Payment $payment): bool
    {
        return $user->can('restore_payment');
    }

    /**
     * Determine whether the user can bulk restore payments.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_payment');
    }

    /**
     * Determine whether the user can replicate a payment.
     */
    public function replicate(User $user, Payment $payment): bool
    {
        return $user->can('replicate_payment');
    }

    /**
     * Determine whether the user can reorder payments.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_payment');
    }
}
