<?php

namespace Tests\Feature\Task;

use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function testTaskDeleteWhenUserIsOwnerTaskAndLoggedIn(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $status = Status::factory()->create();

        $task = Task::create([
            'user_id' => $user->id,
            'title' => 'sample title',
            'description' => 'sample description',
            'deadline' => '2024-01-25',
            'status_id' => $status->id,
        ]);

        $response = $this->delete(route('tasks.delete', $task->id), [
            'title' => 'update sample title',
            'description' => 'update sample description',
            'deadline' => '2025-01-25',
            'status_id' => $status->id,
        ]);

        $response->assertStatus(200);
    }

    public function testTaskDeleteWhenUserIsNotOwnerTask(): void
    {
        $userTaskOwner = User::factory()->create();

        $anotherUsers = User::factory()->create();

        $this->actingAs($anotherUsers);

        $status = Status::factory()->create();

        $task = Task::create([
            'user_id' => $userTaskOwner->id,
            'title' => 'sample title',
            'description' => 'sample description',
            'deadline' => '2024-01-25',
            'status_id' => $status->id,
        ]);

        $response = $this->delete(route('tasks.delete', $task->id));

        $response->assertStatus(403);
    }
}