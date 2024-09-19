<?php

namespace App\Models\Scopes;

use App\Enums\UserRoleTypes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class TaskAccessScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $user = Auth::user();

        if ($user && $user->role === UserRoleTypes::Client->value) {
            $builder->where('assigned_to', $user->id);
        }
    }
}
