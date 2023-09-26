<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tasks\StoreTaskRequest;
use App\Http\Resources\Tasks\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

/**
 * @group Tasks
 */
class StoreTaskController extends Controller
{
    /**
     * Tasks Store
     *
     * @bodyParam title string required
     * @bodyParam description string
     * @bodyParam deadline date_format
     * @bodyParam status_id integer required
     *
     */
    public function store(StoreTaskRequest $request)
    {
        $task = Task::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'status_id' => $request->status_id,
        ]);

        return new TaskResource($task);
    }
}
