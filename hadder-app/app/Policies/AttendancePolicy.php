<?php

namespace App\Policies;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AttendancePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        return $user->role === "admin"
            ? Response::allow()
            : Response::deny('do not have permission');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Attendance $attendance)
    {
        return $user->role === "admin" || $user->id === $attendance->user_id
            ? Response::allow()
            : Response::deny('do not have permission');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Attendance $attendance)
    {
        return $user->role === "admin"
            ? Response::allow()
            : Response::deny('do not have permission');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Attendance $attendance)
    {
        return $user->role === "admin"
            ? Response::allow()
            : Response::deny('do not have permission');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Attendance $attendance): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Attendance $attendance): bool
    {
        //
    }
}
