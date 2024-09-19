<?php

namespace App\Models;

use App\Models\Scopes\TaskAccessScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Model;


/**
 * be aware that because of global scope usage, it's critically discouraged to use anything but eloquent model for CRUD actions
 */
#[ScopedBy([TaskAccessScope::class])]
class Task extends Model
{
    protected $fillable = [
        'task_name',
        'description',
        'assigned_to',
        'due_date',
        'status'
    ];
}
