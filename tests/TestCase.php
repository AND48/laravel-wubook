<?php

namespace AND48\LaravelWubook\Tests;


use AND48\LaravelWubook\Facades\WuBook;
use AND48\LaravelWubook\Models\WubookConfig;
use AND48\LaravelWubook\WuBookServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    private array $credentials;

    public function setUp(): void
    {
        parent::setUp();
        // additional setup
        $this->credentials = $this->createConfig()->only(['lcode','token']);
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

    private function createConfig(){
        return WubookConfig::create([
            'lcode' => getenv('LCODE'),
            'token' => getenv('TOKEN'),
        ]);
    }

    public function getCredentials(){
        return $this->credentials;
    }

    protected function getRid(){
        $response = WuBook::rooms($this->getCredentials())->fetch_rooms();
        return $response['data'][count($response['data'])-1]['id'];
    }

    protected function createRoom(){
        $data = [
            'woodoo' => 1,
            'name' => 'Test',
            'beds' => 2,
            'defprice' => 10000,
            'avail' => 5,
            'shortname' => 'TEST',
            'defboard' => 'nb'
        ];
        $response = WuBook::rooms($this->getCredentials())->fetch_rooms();
        if($response['data'][count($response['data'])-1]['shortname'] ?? '' == 'TEST'){
            return $response['data'][count($response['data'])-1]['id'];
        }
        return WuBook::rooms($this->getCredentials())->new_room($data)['data'] ?? false;
    }

    protected function delRoom(){
        $rid = $this->getRid();
        WuBook::rooms($this->getCredentials())->del_room($rid);
    }
}
