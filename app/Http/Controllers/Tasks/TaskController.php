<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tasks\StoreTaskRequest;
use App\Http\Resources\Tasks\TaskCollection;
use App\Http\Resources\Tasks\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

/**
 * @group Tasks
 */
class TaskController extends Controller
{
    /**
     * Tasks List
     *
     * @queryParam title string
     * @queryParam status string
     * @queryParam greater_or_equal string sample=deadline,2023-12-05
     * @queryParam less_or_equal string sample=deadline,2023-12-05
     *
     */
    public function index()
    {
        $limit = \request('limit', 10);

        $page = \request('page', 1);

        $query = Task::filter()->where('assignee_id', auth()->id());

        $cloneQuery = clone $query;

        $tasks = $query->take($limit)->skip(($page - 1) * $limit)->get();

        return new TaskCollection($tasks, $limit, $page, $cloneQuery);
    }

    /**
     * Tasks Store
     *
     * @bodyParam title string required
     * @bodyParam description string
     * @bodyParam deadline date_format
     * @bodyParam status string
     *
     */
    public function store(StoreTaskRequest $request)
    {
        $task = Task::create([
            'assignee_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'status' => $request->status,
        ]);

        return new TaskResource($task);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Tasks Update
     *
     * @urlParam task integer required
     *
     * @bodyParam title string required
     * @bodyParam description string
     * @bodyParam deadline date_format
     * @bodyParam status_id integer required
     *
     */
    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $task = $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'status' => $request->status,
        ]);

        return response(__('tasks.messages.update'));
    }

    /**
     * Tasks Delete
     *
     * @urlParam task integer required
     *
     */
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return response(__('tasks.messages.delete'));
    }
}
