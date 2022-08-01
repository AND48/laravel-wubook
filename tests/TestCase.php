<?php

namespace AND48\LaravelWubook\Tests;


use AND48\LaravelWubook\WuBookServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        // additional setup
    }

    protected function getPackageProviders($app)
    {
        return [
            WuBookServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
        include_once __DIR__ . '/../database/migrations/create_wubook_configs_table.php.stub';

        // run the up() method of that migration class
        (new \CreateWubookConfigsTable)->up();
    }
}
