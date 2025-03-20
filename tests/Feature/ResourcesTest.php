<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Resource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ResourcesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Проверяет структуру ответа для resources
     *
     * @return void
     */
    public function test_resouces_index()
    {
        Resource::factory()->create();

        $response = $this->get(route('resources.index'));

        $response->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
                $json->has('success')
                    ->has('data.0', fn (AssertableJson $json) =>
                        $json->has('id')
                            ->has('name')
                            ->has('type')
                            ->has('description')
                            ->has('created_at')
                            ->has('updated_at')
                            ->etc()
                    )
            );
    }

    public function test_resouces_store()
    {
        $response = $this->post(route('resources.store'), [
            'name' => 'Standard Room',
            'type' => 'room',
            'description' => 'Room description',
        ]);

        $response->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
                $json->has('success')
                    ->where('success', true)
                    ->has('data')
                    ->where('data', null)
            );
    }

    public function test_resouces_bookings()
    {
        $resource = Resource::factory()->create();
        Booking::factory()->create([
            'resource_id' => $resource->id,
        ]);

        $response = $this->get(route('resources.getBookings', ['resource' => $resource->id]));

        $response->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
                $json->has('success')
                    ->has('data.0', fn (AssertableJson $json) =>
                        $json->has('id')
                            ->has('resource_id')
                            ->has('user_id')
                            ->has('start_time')
                            ->has('end_time')
                            ->has('created_at')
                            ->has('updated_at')
                            ->etc()
                        )
            );
    }
}
