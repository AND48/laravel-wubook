<?php

namespace AND48\LaravelWubook\Tests\Unit;

use AND48\LaravelWubook\Models\WubookConfig;
use AND48\LaravelWubook\Tests\TestCase;

class ConfigTest extends TestCase
{

    /** @test */
    function a_config_has_a_data()
    {
        $config = WubookConfig::create([
            'lcode' => getenv('LCODE'),
            'token' => getenv('TOKEN'),
        ]);
        $this->assertModelExists($config);
    }

}
