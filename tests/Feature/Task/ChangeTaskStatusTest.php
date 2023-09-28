<?php

namespace Tests\Feature\Task;

use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChangeTaskStatusTest extends TestCase
{
    use RefreshDatabase;

    public function testChangeTaskStatusWhenUserLoggedIngAndOwnerTask(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $statuses = Status::factory()->count(4)->create();

        $task = $this->post(route('tasks.store'), [
            'user_id' => $user->id,
            'title' => 'sample title',
            'description' => 'sample description',
            'deadline' => '2024-01-25',
            'status_id' => $statuses->first()->id,
        ]);

        $response = $this->put(route('change.task.status', $task->getOriginalContent()->id), [
            'status_id' => 2,
        ]);

        $response->assertStatus(200);
    }

    public function testChangeTaskStatusWhenUserNotLoggedInAndOwnerTask(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $statuses = Status::factory()->count(4)->create();

        $task = $this->post(route('tasks.store'), [
            'user_id' => $user->id,
            'title' => 'sample title',
            'description' => 'sample description',
            'deadline' => '2024-01-25',
            'status_id' => $statuses->first()->id,
        ]);

        $this->post(route('logout'));

        $response = $this->put(route('change.task.status', $task->getOriginalContent()->id), [
            'status_id' => 2,
        ]);

        $response->assertStatus(302);
    }

    public function testChangeTaskStatusWhenUserLoggedInAndNotOwnerTask(): void
    {
        $user = User::factory()->create();

        $anotherUser = User::factory()->create();

        $this->actingAs($user);

        $statuses = Status::factory()->count(4)->create();

        $task = $this->post(route('tasks.store'), [
            'user_id' => $user->id,
            'title' => 'sample title',
            'description' => 'sample description',
            'deadline' => '2024-01-25',
            'status_id' => $statuses->first()->id,
        ]);

        $this->post(route('logout'));

        $this->actingAs($anotherUser);

        $response = $this->put(route('change.task.status', $task->getOriginalContent()->id), [
            'status_id' => 2,
        ]);

        $response->assertStatus(302);
    }
}
