<?php

namespace AND48\LaravelWubook\Tests\Feature;

use AND48\LaravelWubook\Facades\WuBook;
use AND48\LaravelWubook\Models\WubookConfig;
use AND48\LaravelWubook\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoomTest extends TestCase
{
    use RefreshDatabase;

    private function createConfig(){
        return WubookConfig::create([
            'lcode' => getenv('LCODE'),
            'token' => getenv('TOKEN'),
        ]);
    }

    /** @test */
    function new_room()
    {
        $credentials = $this->createConfig();
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
        $response = WuBook::rooms($credentials->only(['lcode','token']))->new_room($data);
        $this->assertFalse($response['has_error']);
        $rid = $response['data'];

        $response = WuBook::rooms($credentials->only(['lcode','token']))->fetch_single_room($rid);
        $this->assertFalse($response['has_error']);
        $this->assertEquals($code, $response['data'][0]['shortname']);
    }

    /** @test */
    function mod_room()
    {
        $credentials = $this->createConfig();
        $response = WuBook::rooms($credentials->only(['lcode','token']))->fetch_rooms();
        $this->assertFalse($response['has_error']);
        $rid = $response['data'][0]['id'];
        $code = 'TRPL';
        $data = [
            'name' => 'Double',
            'beds' => 2,
            'defprice' => 10000,
            'avail' => 5,
            'shortname' => $code,
            'defboard' => 'nb'
        ];
        $response = WuBook::rooms($credentials->only(['lcode','token']))->mod_room($rid, $data);
        $this->assertFalse($response['has_error']);
//
        $response = WuBook::rooms($credentials->only(['lcode','token']))->fetch_single_room($rid);
        $this->assertFalse($response['has_error']);
        $this->assertEquals($code, $response['data'][0]['shortname']);
    }

    /** @test */
    function del_room()
    {
        $credentials = $this->createConfig();
        $response = WuBook::rooms($credentials->only(['lcode','token']))->fetch_rooms();
//        dd($response);
        $this->assertFalse($response['has_error']);
        $rid = $response['data'][0]['id'];
        $expectedCount = count($response['data']) - 1;
        $response = WuBook::rooms($credentials->only(['lcode','token']))->del_room($rid);
//        dd($response);
        $this->assertFalse($response['has_error']);

        $response = WuBook::rooms($credentials->only(['lcode','token']))->fetch_rooms();
        $this->assertFalse($response['has_error']);
        $this->assertCount($expectedCount, $response['data']);
    }
}

