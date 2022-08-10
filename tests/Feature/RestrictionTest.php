<?php

namespace AND48\LaravelWubook\Tests\Feature;

use AND48\LaravelWubook\Facades\WuBook;
use AND48\LaravelWubook\Tests\TestCase;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class RestrictionTest extends TestCase
{
    private function restrictions()
    {
        return WuBook::restrictions($this->getCredentials());
    }

    private function getRestriction(){
        $response = $this->restrictions()->rplan_rplans();
        $this->assertFalse($response['has_error']);
        return $response['data'][count($response['data'])-1];
    }

    /** @test */
    function rplan_add_rplan()
    {
        $name = 'TEST';
        $response = $this->restrictions()->rplan_add_rplan($name);
        $this->assertFalse($response['has_error']);

        $this->assertEquals($name, $this->getRestriction()['name']);
    }

    /** @test */
    function rplan_rename_rplan()
    {
        $restriction = $this->getRestriction();
        $name = 'TEST_UPD';
        $response = $this->restrictions()->rplan_rename_rplan($restriction['id'], $name);
        $this->assertFalse($response['has_error']);

        $response = $this->restrictions()->rplan_rplans();
        $this->assertFalse($response['has_error']);
        $plan = Arr::first(Arr::where($response['data'], function ($plan) use ($restriction){
            return $plan['id'] == $restriction['id'];
        }));
        $this->assertEquals($name, $plan['name'] ?? '');
    }

    /** @test */
    function rplan_update_rplan_values()
    {
        $restriction = $this->getRestriction();
        $rid = $this->createRoom();
        $response = $this->restrictions()->rplan_update_rplan_values($restriction['id'], Carbon::tomorrow(), (object)[
            $rid => [ ['min_stay' => 3], [], ['max_stay' => 4]],
        ]);
        $this->assertFalse($response['has_error']);

        $response = $this->restrictions()->rplan_get_rplan_values(Carbon::tomorrow(), Carbon::tomorrow()->addDays(2), [$restriction['id']]);
        $this->assertFalse($response['has_error']);
        $this->assertEquals(4, $response['data'][$restriction['id']][$rid][2]['max_stay']);
        $this->delRoom();
    }

    /** @test */
    function rplan_del_rplan()
    {
        $id = $this->getRestriction()['id'];
        $response = $this->restrictions()->rplan_del_rplan($id);
        $this->assertFalse($response['has_error']);
    }

}

