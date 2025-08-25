<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Task;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    protected $headers = [];

    protected function setUp(): void
    {
        parent::setUp();
        $this->headers = [
            'Authorization' => 'Bearer ' . env('API_TOKEN')
        ];
    }

    public function test_user_can_create_task()
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/tasks', [
            'title' => 'Mi tarea de prueba',
            'description' => 'Descripcion de prueba',
            'status' => 'pending',
            'user_id' => $user->id,
        ], $this->headers);

        $response->assertStatus(201)
                 ->assertJson([
                     'title' => 'Mi tarea de prueba',
                     'user_id' => $user->id,
                 ]);

        $this->assertDatabaseHas('tasks', ['title' => 'Mi tarea de prueba']);
    }

    public function test_invalid_task_creation_fails()
    {
        $response = $this->postJson('/api/tasks', [
            'title' => 'abc', // demasiado corto
            'user_id' => 999, // usuario inexistente
        ], $this->headers);

        $response->assertStatus(422); // validación falla
    }

    public function test_task_can_be_deleted()
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['user_id' => $user->id]);

        $response = $this->deleteJson("/api/tasks/{$task->id}", [], $this->headers);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Task deleted']);

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
