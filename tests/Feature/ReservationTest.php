<?php

namespace AND48\LaravelWubook\Tests\Feature;

use AND48\LaravelWubook\Facades\WuBook;
use AND48\LaravelWubook\Tests\TestCase;
use Carbon\Carbon;

class ReservationTest extends TestCase
{
    private function reservations(){
        return WuBook::reservations($this->getCredentials());
    }

    /** @test */
    function fetch_new_bookings()
    {
        $response = $this->reservations()->fetch_new_bookings();
        $this->assertFalse($response['has_error']);
    }

    /** @test */
    function fetch_bookings()
    {
        $response = $this->reservations()->fetch_bookings(Carbon::yesterday());
        $this->assertFalse($response['has_error']);
    }
}

