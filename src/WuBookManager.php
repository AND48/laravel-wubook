<?php

/*
 * This file is part of Laravel WuBook.
 *
 * (c) Filippo Galante <filippo.galante@b-ground.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AND48\LaravelWubook;

use AND48\LaravelWubook\Api\WuBookAvailability;
use AND48\LaravelWubook\Api\WuBookPrices;
use fXmlRpc\Client;
use fXmlRpc\Parser\NativeParser;
use fXmlRpc\Serializer\NativeSerializer;
use AND48\LaravelWubook\Api\WuBookRooms;

/**
 * This is the WuBook manager class.
 *
 * @author Filippo Galante <filippo.galante@b-ground.com>
 */
class WuBookManager
{

    /**
     * @var string
     */
    const ENDPOINT = 'https://wired.wubook.net/xrws/';

    /**
     * @var fXmlRpc\Client
     */
    private $client;

    public function __construct(){
        $this->client = new Client(self::ENDPOINT);
    }

    /**
     * Rooms API
     *
     * @param array $credentials
     * @return AND48\LaravelWubook\Api\WuBookRooms
     */
    public function rooms(array $credentials)
    {
        return new WuBookRooms($credentials, $this->client);
    }

    /**
     * Rooms API
     *
     * @param array $credentials
     * @return AND48\LaravelWubook\Api\WuBookAvailability
     */
    public function availability(array $credentials)
    {
        return new WuBookAvailability($credentials, $this->client);
    }

    /**
     * Rooms API
     *
     * @param array $credentials
     * @return AND48\LaravelWubook\Api\WuBookPrices
     */
    public function prices(array $credentials)
    {
        return new WuBookPrices($credentials, $this->client);
    }


    /**
     * Client getter.
     *
     * @return PhpXmlRpc\Client
     */
    public function get_client()
    {
        return $this->client;
    }
}
