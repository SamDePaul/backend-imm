<?php

namespace App\Policies;

use App\Models\Survey;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SurveyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the survey.
     */
    public function view(User $user, Survey $survey)
    {
        return $user->id === $survey->user_id;
    }

    /**
     * Determine whether the user can update the survey.
     */
    public function update(User $user, Survey $survey)
    {
        return $user->id === $survey->user_id;
    }

    /**
     * Determine whether the user can delete the survey.
     */
    public function delete(User $user, Survey $survey)
    {
        return $user->id === $survey->user_id;
    }
}
