<?php

namespace App\Http\Controllers\TaskStatuses;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskStatuses\ChangeTaskStatusRequest;
use App\Models\Task;
use Illuminate\Http\Request;

/**
 * @group Task Statuses
 */
class ChangeTaskStatusController extends Controller
{
    /**
     * Task Statuses Change
     *
     * @bodyParam status_id integer required
     *
     * @urlParam task integer required
     *
     *
     */
    public function changeStatus(ChangeTaskStatusRequest $request, Task $task)
    {
        if (auth()->id() != $task->user_id) {
            throw new \InvalidArgumentException(__('tasks.exceptions.not_for_user'));
        }

        $task->update([
            'status_id' => $request->status_id,
        ]);

        return response(__('tasks.messages.update'));
    }
}
