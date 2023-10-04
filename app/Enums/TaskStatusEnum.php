<?php

namespace App\Enums;

enum TaskStatusEnum: string
{
    case Todo = 'todo';
    case Doing = 'doing';
    case Done = 'done';
}
