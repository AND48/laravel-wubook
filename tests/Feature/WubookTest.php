<?php

namespace AND48\LaravelWubook\Tests\Feature;

use AND48\LaravelWubook\Facades\WuBook;
use AND48\LaravelWubook\Models\WubookConfig;
use AND48\LaravelWubook\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WubookTest extends TestCase
{
    use RefreshDatabase;

    private function createConfig(){
        return WubookConfig::create([
            'lcode' => getenv('LCODE'),
            'token' => getenv('TOKEN'),
        ]);
    }

    /** @test */
    function fetch_rooms()
    {
        $credentials = $this->createConfig();
        $response = WuBook::rooms($credentials->only(['lcode','token']))->fetch_rooms();
        dump($response);
    }


}

