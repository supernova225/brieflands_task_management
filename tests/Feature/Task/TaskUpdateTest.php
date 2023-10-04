<?php

namespace Tests\Feature\Task;

use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function testTaskUpdateWhenUserLoggedIn(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $task = Task::create([
            'assignee_id' => $user->id,
            'title' => 'sample title',
            'description' => 'sample description',
            'deadline' => '2024-01-25',
            'status' => 'todo',
        ]);

        $response = $this->put(route('tasks.update', $task->id), [
            'title' => 'update sample title',
            'description' => 'update sample description',
            'deadline' => '2025-01-25',
            'status' => 'todo',
        ]);

        $response->assertStatus(200);
    }

    public function testTaskUpdateWhenUserNotLoggedIn(): void
    {
        $user = User::factory()->create();

        $task = Task::create([
            'assignee_id' => $user->id,
            'title' => 'sample title',
            'description' => 'sample description',
            'deadline' => '2024-01-25',
            'status' => 'todo',
        ]);

        $response = $this->put(route('tasks.update', $task->id), [
            'title' => 'update sample title',
            'description' => 'update sample description',
            'deadline' => '2025-01-25',
            'status' => 'todo',
        ]);


        $response->assertStatus(302);
    }

    public function testTaskUpdateWhenUserIsNotOwnerTask(): void
    {
        $userTaskOwner = User::factory()->create();

        $anotherUsers = User::factory()->create();

        $this->actingAs($anotherUsers);

        $task = Task::create([
            'assignee_id' => $userTaskOwner->id,
            'title' => 'sample title',
            'description' => 'sample description',
            'deadline' => '2024-01-25',
            'status' => 'todo',
        ]);

        $response = $this->put(route('tasks.update', $task->id), [
            'title' => 'update sample title',
            'description' => 'update sample description',
            'deadline' => '2025-01-25',
            'status' => 'doing',
        ]);

        $response->assertStatus(403);
    }
}
