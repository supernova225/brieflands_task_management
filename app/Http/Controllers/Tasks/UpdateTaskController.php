<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tasks\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

/**
 * @group Tasks
 */
class UpdateTaskController extends Controller
{
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
     *
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        if (auth()->id() != $task->user_id) {
            throw new \InvalidArgumentException('تسک مورد نظر برای شما نمی‌باشد.');
        }

        $task = $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'status_id' => $request->status_id,
        ]);

        return response(['message' => 'تسک مورد نظر با موفقیت ویرایش شد.']);
    }
}
