<?php

namespace AND48\LaravelWubook\Tests\Feature;

use AND48\LaravelWubook\Facades\WuBook;
use AND48\LaravelWubook\Tests\TestCase;

class RoomTest extends TestCase
{
    private function rooms(){
        return WuBook::rooms($this->getCredentials());
    }

    /** @test */
    function new_room()
    {
        $code = 'DBL';
        $data = [
            'woodoo' => 1,
            'name' => 'Double',
            'beds' => 2,
            'defprice' => 10000,
            'avail' => 5,
            'shortname' => $code,
            'defboard' => 'nb'
        ];
        $response = $this->rooms()->new_room($data);
        $this->assertFalse($response['has_error']);
        $rid = $response['data'];

        $response = $this->rooms()->fetch_single_room($rid);
        $this->assertFalse($response['has_error']);
        $this->assertEquals($code, $response['data'][0]['shortname']);
    }

    /** @test */
    function mod_room()
    {
        $code = 'TRPL';
        $data = [
            'name' => 'Double',
            'beds' => 2,
            'defprice' => 10000,
            'avail' => 5,
            'shortname' => $code,
            'defboard' => 'nb'
        ];
        $rid = $this->getRid();

        $response = $this->rooms()->mod_room($rid, $data);
        $this->assertFalse($response['has_error']);

        $response = $this->rooms()->fetch_single_room($rid);
        $this->assertFalse($response['has_error']);
        $this->assertEquals($code, $response['data'][0]['shortname']);
    }

    /** @test */
    function del_room()
    {
        $response = $this->rooms()->fetch_rooms();
        $this->assertFalse($response['has_error']);
        $rid = $response['data'][count($response['data'])-1]['id'];

        $expectedCount = count($response['data']) - 1;
        $response = $this->rooms()->del_room($rid);
        $this->assertFalse($response['has_error']);

        $response = $this->rooms()->fetch_rooms();
        $this->assertFalse($response['has_error']);
        $this->assertCount($expectedCount, $response['data']);
    }
}

