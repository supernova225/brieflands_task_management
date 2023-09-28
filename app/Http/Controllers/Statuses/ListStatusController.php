<?php

namespace App\Http\Controllers\Statuses;

use App\Http\Controllers\Controller;
use App\Http\Resources\Statuses\StatusResource;
use App\Models\Status;
use Illuminate\Http\Request;

/**
 * @group Statuses
 */
class ListStatusController extends Controller
{
    /**
     * Statuses List
     *
     */
    public function list()
    {
        $statuses = Status::get();

        return StatusResource::collection($statuses);
    }
}
