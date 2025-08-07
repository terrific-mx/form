<?php

namespace App\Policies;

use App\Models\Submission;
use App\Models\User;

class SubmissionPolicy
{
    /**
     * Determine whether the user can view the submission.
     */
    public function view(User $user, Submission $submission): bool
    {
        return $user->id === $submission->form->user_id;
    }
}
