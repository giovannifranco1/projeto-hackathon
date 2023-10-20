<?php

namespace App\Policies;

use App\Models\SolicitacaoRecurso;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SolicitacaoRecursoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isUser();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, SolicitacaoRecurso $solicitacaoRecurso): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isUser();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, SolicitacaoRecurso $solicitacaoRecurso): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SolicitacaoRecurso $solicitacaoRecurso): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, SolicitacaoRecurso $solicitacaoRecurso): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, SolicitacaoRecurso $solicitacaoRecurso): bool
    {
        return $user->isAdmin();
    }
}
