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
 * Description of WuBookReservations
 *
 * @author Filippo Galante <filippo.galante@b-ground.com>
 */
class WuBookReservations extends WuBookApi
{
    /**
     * https://tdocs.wubook.net/wired/fetch.html#push_activation
     *
     * @param string $url
     * @param int $test
     * @return mixed
     */
    public function push_activation(string $url, int $test = 0)
    {
        return $this->call_method('push_activation', [$url, $test]);
    }

    /**
     * https://tdocs.wubook.net/wired/fetch.html#push_url
     *
     * @return mixed
     */
    public function push_url()
    {
        return $this->call_method('push_url');
    }

    /**
     * https://tdocs.wubook.net/wired/fetch.html#fetch_new_bookings
     *
     * @param int $ancillary
     * @param int $mark
     * @return mixed
     */
    public function fetch_new_bookings(int $ancillary = 0, int $mark = 1)
    {
        return $this->call_method('fetch_new_bookings', [$ancillary, $mark]);
    }

    /**
     * https://tdocs.wubook.net/wired/fetch.html#mark_bookings
     *
     * @param array $reservations
     * @return mixed
     */
    public function mark_bookings(array $reservations = [])
    {
        return $this->call_method('mark_bookings', [$reservations]);
    }

    /**
     * https://tdocs.wubook.net/wired/fetch.html#fetch_bookings
     *
     * @param Carbon $dfrom
     * @param Carbon $dto
     * @param int $oncreated
     * @param int $ancillary
     * @return mixed
     */
    public function fetch_bookings(Carbon $dfrom = null, Carbon $dto = null, int $oncreated = 1, int $ancillary = 0)
    {
        return $this->call_method('fetch_bookings', [$this->formatDate($dfrom), $this->formatDate($dto), $oncreated, $ancillary]);
    }

    /**
     * https://tdocs.wubook.net/wired/fetch.html#fetch_booking
     *
     * @param int $rcode
     * @param int $ancillary
     * @return mixed
     */
    public function fetch_booking(int $rcode, int $ancillary = 0)
    {
        return $this->call_method('fetch_booking', [$rcode, $ancillary]);
    }
}
