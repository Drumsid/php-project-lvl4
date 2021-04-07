<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Label;
use Illuminate\Support\Arr;
use App\Models\User;

class LabelControllerTest extends TestCase
{
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        Label::factory()->count(2)->make();
        $this->user = User::factory()->create();
    }

    public function testIndex(): void
    {
        $response = $this->get(route('labels.index'));
        $response->assertOk();
    }

    public function testCreate(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route('labels.create'));
        $response->assertOk();
    }

    public function testStore(): void
    {
        $factoryData = Label::factory()->make()->toArray();
        $data = Arr::only($factoryData, ['name']);
        $response = $this->actingAs($this->user)
            ->post(route('labels.store'), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('labels', $data);
    }

    public function testEdit(): void
    {
        $label = Label::factory()->create();
        $response = $this->actingAs($this->user)
            ->get(route('labels.edit', [$label]));
        $response->assertOk();
    }

    public function testUpdate(): void
    {
        $label = Label::factory()->create();
        $factoryData = Label::factory()->make()->toArray();
        $data = Arr::only($factoryData, ['name']);
        $response = $this->actingAs($this->user)
            ->patch(route('labels.update', $label), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('labels', $data);
    }

    public function testDestroy(): void
    {
        $label = Label::factory()->create();
        $response = $this->actingAs($this->user)
            ->delete(route('labels.destroy', [$label]));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseMissing('labels', ['id' => $label->id]);
    }
}
