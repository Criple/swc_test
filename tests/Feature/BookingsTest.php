<?php

namespace Tests\Feature;

use App\Mail\ResourceBooked;
use App\Mail\ResourceBookingCanceled;
use App\Models\Booking;
use App\Models\Resource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class BookingsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_booking_store()
    {
        Mail::fake();

        Resource::factory()->create();

        $response = $this->post(route('bookings.store'), [
            'resource_id' => 1,
            'user_id' => 1,
            'start_time' => date('Y-m-d H:i:s'),
            'end_time' => date('Y-m-d H:i:s', strtotime('+7 days'))
        ]);

        $this->assertDatabaseHas('bookings', [
            'resource_id' => 1,
            'user_id' => 1
        ]);

        Mail::assertSent(ResourceBooked::class, static function ($mail) {
            return $mail->hasTo('test@test.test');
        });

        $response->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
                $json->has('success')
                    ->where('success', true)
                    ->has('data')
                    ->where('data', null)
            );
    }

    public function test_booking_destroy()
    {
        Mail::fake();

        $booking = Booking::factory()->create();

        $response = $this->delete(route('bookings.destroy', ['booking' => $booking->id]), []);

        Mail::assertSent(ResourceBookingCanceled::class, static function ($mail) {
            return $mail->hasTo('test@test.test');
        });

        $response->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
            $json->has('success')
                ->where('success', true)
                ->has('data')
                ->where('data', null)
            );
    }
}
