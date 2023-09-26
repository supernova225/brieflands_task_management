<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Http\Resources\Tasks\TaskCollection;
use App\Models\Task;
use Illuminate\Http\Request;

/**
 * @group Tasks
 */
class ListTaskController extends Controller
{
    /**
     * Tasks List
     *
     * @queryParam limit integer
     * @queryParam page integer
     * @queryParam search string
     * @queryParam status_id integer
     *
     */
    public function list()
    {
        $limit = \request('limit', 10);

        $page = \request('page', 1);

        [$tasks, $cloneQuery] = $this->getTasks($limit, $page);

        return new TaskCollection($tasks, $limit, $page, $cloneQuery);
    }

    private function getTasks(int $limit, int $page)
    {
        $query = Task::where('user_id', auth()->id());

        if (\request('search')) {
            $query->where('title', 'like', '%' . \request('search') . '%');
        }

        if (\request('status_id')) {
            $query->where('status_id', \request('status_id'));
        }

        $cloneQuery = clone $query;

        $tasks = $query->take($limit)->skip(($page - 1) * $limit)->get();

        return [$tasks, $cloneQuery];
    }
}
