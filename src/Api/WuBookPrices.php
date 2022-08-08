<?php

/*
 * This file is part of Laravel WuBook.
 *
 * (c) Filippo Galante <filippo.galante@b-ground.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AND48\LaravelWubook\Api;

use AND48\LaravelWubook\Api\WuBookApi;
use Carbon\Carbon;

/**
 * Description of WuBookPrices
 *
 * @author Filippo Galante <filippo.galante@b-ground.com>
 */
class WuBookPrices extends WuBookApi
{

    /**
     * https://tdocs.wubook.net/wired/prices.html#add_pricing_plan
     *
     * @param string $name
     * @param int $daily 0|1
     * @return mixed
     */
    public function add_pricing_plan($name, int $daily = 1)
    {
        return $this->call_method('add_pricing_plan', [$name, $daily]);
    }

    /**
     * https://tdocs.wubook.net/wired/prices.html#del_plan
     *
     * @param int $id
     * @return mixed
     */
    public function del_plan($id)
    {
        return $this->call_method('del_plan', [$id]);
    }

    /**
     * https://tdocs.wubook.net/wired/prices.html#update_plan_name
     *
     * @param int $id
     * @param string $name
     * @return mixed
     */
    public function update_plan_name(int $id, $name)
    {
        return $this->call_method('update_plan_name', [$id, $name]);
    }

    /**
     * https://tdocs.wubook.net/wired/prices.html#get_pricing_plans
     *
     * @return mixed
     */
    public function get_pricing_plans()
    {
        return $this->call_method('get_pricing_plans');
    }

    /**
     * https://tdocs.wubook.net/wired/prices.html#update_plan_prices
     *
     * @param int $id
     * @param Carbon $dfrom
     * @param object $prices
     * @return mixed
     */
    public function update_plan_prices(int $id, Carbon $dfrom, object $prices)
    {
        return $this->call_method('update_plan_prices', [$id, $this->formatDate($dfrom), $prices]);
    }

    /**
     * https://tdocs.wubook.net/wired/prices.html#fetch_plan_prices
     *
     * @param int $id
     * @param Carbon $dfrom
     * @param Carbon $dto
     * @param array $rooms
     * @return mixed
     */
    public function fetch_plan_prices(int $id, Carbon $dfrom, Carbon $dto, array $rooms = [])
    {
        return $this->call_method('fetch_plan_prices', [$id, $this->formatDate($dfrom), $this->formatDate($dto), $rooms]);
    }
}
