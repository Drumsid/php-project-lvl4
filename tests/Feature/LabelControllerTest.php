<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Label;
use Illuminate\Support\Arr;

class LabelControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Label::factory()->count(2)->make();
    }

    public function testIndex(): void
    {
        $response = $this->get(route('labels.index'));
        $response->assertOk();
    }

    public function testCreate(): void
    {
        $response = $this->get(route('labels.create'));
        $response->assertOk();
    }

    public function testStore()
    {
        $factoryData = Label::factory()->make()->toArray();
        $data = Arr::only($factoryData, ['name']);
        $response = $this->post(route('labels.store'), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('labels', $data);
    }

    public function testEdit()
    {
        $label = Label::factory()->create();
        $response = $this->get(route('labels.edit', [$label]));
        $response->assertOk();
    }

    public function testUpdate()
    {
        $label = Label::factory()->create();
        $factoryData = Label::factory()->make()->toArray();
        $data = Arr::only($factoryData, ['name']);
        $response = $this->patch(route('labels.update', $label), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('labels', $data);
    }

    public function testDestroy()
    {
        $label = Label::factory()->create();
        $response = $this->delete(route('labels.destroy', [$label]));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseMissing('labels', ['id' => $label->id]);
    }
}