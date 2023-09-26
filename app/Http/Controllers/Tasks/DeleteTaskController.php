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
            throw new \InvalidArgumentException('تسک مورد نظر برای شما نمی‌باشد.');
        }

        $task->delete();

        return response(['message' => 'تسک مورد نظر با موفقیت حذف شد.']);
    }
}
