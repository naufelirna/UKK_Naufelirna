<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Guru;
use Illuminate\Auth\Access\HandlesAuthorization;

class GuruPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can VIEW ANY models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_guru');
    }

    /**
     * Determine whether the user can VIEW the model.
     */
    public function view(User $user, Guru $guru): bool
    {
        return $user->can('view_guru');
    }

    /**
     * Determine whether the user can CREATE models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_guru');
    }

    /**
     * Determine whether the user can UPDATE/NGEDIT the model.
     */
    public function update(User $user, Guru $guru): bool
    {
        return $user->can('update_guru');
    }

    /**
     * Determine whether the user can DELETE the model.
     */
    public function delete(User $user, Guru $guru): bool
    {
        return $user->can('delete_guru');
    }

    /**
     * Determine whether the user can BULK/HAPUS BANYAK/SEKALIGUS delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_guru');
    }

    /**
     * Determine whether the user can PERMANENTLY DELETE.
     */
    public function forceDelete(User $user, Guru $guru): bool
    {
        return $user->can('force_delete_guru');
    }

    /**
     * Determine whether the user can PERMANENTLY BULK DELETE.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_guru');
    }

    /**
     * Determine whether the user can RESTORE.
     */
    public function restore(User $user, Guru $guru): bool
    {
        return $user->can('restore_guru');
    }

    /**
     * Determine whether the user can BULK RESTORE.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_guru');
    }

    /**
     * Determine whether the user can REPLICATE.
     */
    public function replicate(User $user, Guru $guru): bool
    {
        return $user->can('replicate_guru');
    }

    /**
     * Determine whether the user can REORDER.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_guru');
    }
}
