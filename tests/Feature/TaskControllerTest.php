<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Support\Arr;

class TaskControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        User::factory(1)->create();
    }

    public function testIndex(): void
    {
        $response = $this->get(route('tasks.index'));
        $response->assertOk();
    }

    public function testCreate(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
                         ->withSession(['banned' => false])
                         ->get(route('tasks.create'));
        $response->assertOk();
    }

    public function testStore()
    {
        $factoryData = Task::factory()->make()->toArray();
        $data = Arr::only($factoryData, ['name', 'status_id', 'created_by_id', 'assigned_to_id', 'description']);
        $response = $this->post(route('tasks.store'), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('tasks', $data);
    }

    public function testShow()
    {
        TaskStatus::factory()->create();
        $task = Task::factory()->create();
        $response = $this->get(route('tasks.show', $task->id));
        $response->assertOk();
    }

    public function testEdit()
    {
        $task = Task::factory()->create();
        $user = User::find(1);
        $response = $this->actingAs($user)
                    ->withSession(['banned' => false])
                    ->get(route('tasks.edit', [$task]));
        $response->assertOk();
    }

    public function testUpdate()
    {
        $task = Task::factory()->create();
        $user = User::find(1);

        $factoryData = Task::factory()->make()->toArray();
        $data = Arr::only($factoryData, ['name', 'status_id', 'created_by_id', 'assigned_to_id', 'description']);
        $response = $this->actingAs($user)
                    ->withSession(['banned' => false])
                    ->patch(route('tasks.update', $task), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('tasks', $data);
    }

    public function testDestroy()
    {
        $task = Task::factory()->create();
        $user = User::find(1);
        $response = $this->actingAs($user)
                    ->withSession(['banned' => false])
                    ->delete(route('tasks.destroy', [$task]));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
