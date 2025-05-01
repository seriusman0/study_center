<?php

namespace App\Policies;

use App\Models\Journal;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class JournalPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any journals.
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can create journals.
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the journal.
     */
    public function view(User $user, Journal $journal)
    {
        return $user->id === $journal->user_id;
    }

    /**
     * Determine whether the user can update the journal.
     */
    public function update(User $user, Journal $journal)
    {
        return $user->id === $journal->user_id;
    }

    /**
     * Determine whether the user can delete the journal.
     */
    public function delete(User $user, Journal $journal)
    {
        return $user->id === $journal->user_id;
    }
}
