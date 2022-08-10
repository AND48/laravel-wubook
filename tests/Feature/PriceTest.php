<?php

namespace AND48\LaravelWubook\Tests\Feature;

use AND48\LaravelWubook\Facades\WuBook;
use AND48\LaravelWubook\Tests\TestCase;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class PriceTest extends TestCase
{
    private function prices()
    {
        return WuBook::prices($this->getCredentials());
    }

    private function getPrice(){
        $response = $this->prices()->get_pricing_plans();
        $this->assertFalse($response['has_error']);
        return $response['data'][count($response['data'])-1];
    }

    /** @test */
    function add_pricing_plan()
    {
        $name = 'TEST';
        $response = $this->prices()->add_pricing_plan($name);
        $this->assertFalse($response['has_error']);

        $this->assertEquals($name, $this->getPrice()['name']);
    }

    /** @test */
    function update_plan_name()
    {
        $price = $this->getPrice();
        $name = 'TEST_UPD';
        $response = $this->prices()->update_plan_name($price['id'], $name);
        $this->assertFalse($response['has_error']);

        $response = $this->prices()->get_pricing_plans();
        $this->assertFalse($response['has_error']);
        $plan = Arr::first(Arr::where($response['data'], function ($plan) use ($price){
            return $plan['id'] == $price['id'];
        }));
        $this->assertEquals($name, $plan['name'] ?? '');
    }

    /** @test */
    function update_plan_prices()
    {
        $price = $this->getPrice();
        $rid = $this->createRoom();
        $response = $this->prices()->update_plan_prices($price['id'], Carbon::tomorrow(), (object)[
            $rid => [100, 101, 102],
        ]);
        $this->assertFalse($response['has_error']);

        $response = $this->prices()->fetch_plan_prices($price['id'], Carbon::tomorrow(), Carbon::tomorrow()->addDay(), [$rid]);
        $this->assertFalse($response['has_error']);
        $this->assertEquals(101, $response['data'][$rid][1]);
        $this->delRoom();
    }

    /** @test */
    function del_plan()
    {
        $id = $this->getPrice()['id'];
        $response = $this->prices()->del_plan($id);
        $this->assertFalse($response['has_error']);
    }

}

