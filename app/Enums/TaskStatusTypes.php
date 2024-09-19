<?php

namespace App\Enums;

enum TaskStatusTypes: string
{
    case Pending = 'pending';
    case Completed = 'completed';
    case Failed = 'failed';

}
