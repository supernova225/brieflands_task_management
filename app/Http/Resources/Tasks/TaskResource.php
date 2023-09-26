<?php

namespace App\Http\Resources\Tasks;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user' => [
                'id' => $this->user->id,
                'first_name' => $this?->user?->first_name,
                'last_name' => $this?->user?->last_name,
            ],
            'title' => $this->title,
            'description' => $this?->description,
            'deadline' => $this?->deadline,
            'status' => [
                'id' => $this->status->id,
                'title' => $this->status->title,
                'description' => $this?->status?->description,
            ],
        ];
    }
}
