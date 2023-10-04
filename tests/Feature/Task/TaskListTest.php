<?php

namespace Tests\Feature\Task;

use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskListTest extends TestCase
{
    use RefreshDatabase;

    public function testTaskListWhenUserIsOwnerTasksAndLoggedIn(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $tasks = Task::factory()->count(20)->create();

        $response = $this->get(route('tasks.list'));

        $response->assertStatus(200);
    }

    public function testTaskListWhenUserIsOwnerTasksAndNotLoggedIn(): void
    {
        $user = User::factory()->create();

        $tasks = Task::factory()->count(20)->create();

        $response = $this->get(route('tasks.list'));

        $response->assertStatus(302);
    }
}
