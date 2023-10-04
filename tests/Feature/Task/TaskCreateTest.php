<?php

namespace Tests\Feature\Task;

use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskCreateTest extends TestCase
{
    use RefreshDatabase;

    public function testTaskCreateWhenUserLoggedIn(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->post(route('tasks.store'), [
            'user_id' => $user->id,
            'title' => 'sample title',
            'description' => 'sample description',
            'deadline' => '2024-01-25',
            'status' => 'todo',
        ]);

        $response->assertStatus(201);
    }

    public function testTaskCreateWhenUserNotLoggedIn(): void
    {
        $user = User::factory()->create();

        $response = $this->post(route('tasks.store'), [
            'user_id' => $user->id,
            'title' => 'sample title',
            'description' => 'sample description',
            'deadline' => '2024-01-25',
            'status' => 'todo',
        ]);

        $response->assertStatus(302);
    }
}
