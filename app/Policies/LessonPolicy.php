<?php

namespace App\Policies;

use App\Models\LessonPlan;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LessonPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\LessonPlan $lessonPlan
     * @return mixed
     */
    public function view(User $user, LessonPlan $lessonPlan)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\LessonPlan $lessonPlan
     * @return mixed
     */
    public function update(User $user, LessonPlan $lessonPlan)
    {
        return $user == $lessonPlan->course->user;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\LessonPlan $lessonPlan
     * @return mixed
     */
    public function delete(User $user, LessonPlan $lessonPlan)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\LessonPlan $lessonPlan
     * @return mixed
     */
    public function restore(User $user, LessonPlan $lessonPlan)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\LessonPlan $lessonPlan
     * @return mixed
     */
    public function forceDelete(User $user, LessonPlan $lessonPlan)
    {
        //
    }
}
