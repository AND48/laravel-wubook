<?php

namespace AND48\LaravelWubook\Tests\Feature;

use AND48\LaravelWubook\Facades\WuBook;
use AND48\LaravelWubook\Tests\TestCase;
use Carbon\Carbon;

class AvailabilityTest extends TestCase
{
    private function availability(){
        return WuBook::availability($this->getCredentials());
    }

    /** @test */
    function update_avail()
    {
        $rid = $this->createRoom();
        $response = $this->availability()->update_avail(Carbon::today(), [[
            'id' => $rid,
            'days' => [
                ['avail' => 3],
                [],
                ['no_ota' => 0]],],
        ]);
        $this->assertFalse($response['has_error']);

        $response = $this->availability()->fetch_rooms_values(Carbon::today(), Carbon::tomorrow(), [$rid]);
        $this->assertFalse($response['has_error']);
        $this->assertEquals(3, $response['data'][$rid][0]['avail'] ?? -1);
    }

    /** @test */
    function update_sparse_avail()
    {
        $rid = $this->createRoom();
        $date = Carbon::tomorrow()->addDay();
        $response = $this->availability()->update_sparse_avail([[
            'id' => $rid,
            'days' => [
                ['no_ota' => 1, 'avail' => 6, 'date' => $this->availability()->formatDate($date)],
                ],],
        ]);
        $this->assertFalse($response['has_error']);

        $response = $this->availability()->fetch_rooms_values($date, $date, [$rid]);
        $this->assertFalse($response['has_error']);
        $this->assertEquals(1, $response['data'][$rid][0]['no_ota'] ?? 0);
        $this->assertEquals(6, $response['data'][$rid][0]['avail'] ?? -1);

        $this->delRoom();
    }

}

