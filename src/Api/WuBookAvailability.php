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


use Carbon\Carbon;

/**
 * This is the WuBook availability api class.
 *
 * @author Filippo Galante <filippo.galante@b-ground.com>
 */
class WuBookAvailability extends WuBookApi
{

    /**
     * https://tdocs.wubook.net/wired/avail.html#update_avail
     *
     *
     * @param array $rooms
     * @param Carbon $dfrom
     * @return mixed
     */
    public function update_avail(Carbon $dfrom, array $rooms)
    {
        return $this->call_method( 'update_avail', [$this->formatDate($dfrom), $rooms]);
    }

    /**
     * https://tdocs.wubook.net/wired/avail.html#update_sparse_avail
     *
     *
     * @param array $rooms
     * @return mixed
     */
    public function update_sparse_avail(array $rooms)
    {
//        dd($rooms);
        return $this->call_method('update_sparse_avail', [$rooms]);
    }

    /**
     * https://tdocs.wubook.net/wired/avail.html#fetch_rooms_values
     *
     *
     * @param array $rooms
     * @param Carbon $dfrom
     * @param Carbon $dfrom
     * @return mixed
     */
    public function fetch_rooms_values(Carbon $dfrom, Carbon $dto, array $rooms = [])
    {
        return $this->call_method('fetch_rooms_values',
            [$this->formatDate($dfrom), $this->formatDate($dto), $rooms]);
    }

}
