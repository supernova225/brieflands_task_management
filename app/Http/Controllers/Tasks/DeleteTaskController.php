<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

/**
 * @group Tasks
 */
class DeleteTaskController extends Controller
{
    /**
     * Tasks Delete
     *
     * @urlParam task integer required
     *
     */
    public function delete(Task $task)
    {
        if (auth()->id() != $task->user_id) {
            throw new \InvalidArgumentException(__('tasks.exceptions.not_for_user'));
        }

        $task->delete();

        return response(__('tasks.messages.delete'));
    }
}
