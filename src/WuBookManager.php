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

use fXmlRpc\Client;
use fXmlRpc\Parser\NativeParser;
use fXmlRpc\Serializer\NativeSerializer;
use AND48\LaravelWubook\Api\WuBookAvailability;
use AND48\LaravelWubook\Api\WuBookCancellationPolicies;
use AND48\LaravelWubook\Api\WuBookChannelManager;
use AND48\LaravelWubook\Api\WuBookCorporate;
use AND48\LaravelWubook\Api\WuBookExtras;
use AND48\LaravelWubook\Api\WuBookPrices;
use AND48\LaravelWubook\Api\WuBookReservations;
use AND48\LaravelWubook\Api\WuBookRestrictions;
use AND48\LaravelWubook\Api\WuBookRooms;
use AND48\LaravelWubook\Api\WuBookTransactions;

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
     * @var array
     */
    private $config;

    /**
     * @var fXmlRpc\Client
     */
    private $client;

    public function __construct(){
        $this->client = new Client(self::ENDPOINT, null, new NativeParser(), new NativeSerializer());
    }

    /**
     * Availability API
     *
     * @param string $token
     * @return AND48\LaravelWubook\Api\WuBookAvailability
     */
    public function availability($token = null)
    {
        // Setup client
        $client = new Client(self::ENDPOINT, null, new NativeParser(), new NativeSerializer());

        return new WuBookAvailability($this->config, $this->cache, $client, $token);
    }

    /**
     * Cancellation polices API
     *
     * @param string $token
     * @return AND48\LaravelWubook\Api\WuBookCancellationPolicies
     */
    public function cancellation_policies($token = null)
    {
        $client = new Client(self::ENDPOINT, null, new NativeParser(), new NativeSerializer());

        return new WuBookCancellationPolicies($this->config, $this->cache, $client, $token);
    }

    /**
     * Channel manager API
     *
     * @param string $token
     * @return AND48\LaravelWubook\Api\WuBookChannelManager
     */
    public function channel_manager($token = null)
    {
        // Setup client
        $client = new Client(self::ENDPOINT, null, new NativeParser(), new NativeSerializer());

        return new WuBookChannelManager($this->config, $this->cache, $client, $token);
    }

    /**
     * Corporate function API
     *
     * @param string $token
     * @return AND48\LaravelWubook\Api\WuBookCorporate
     */
    public function corporate_functions($token = null)
    {
        // Setup client
        $client = new Client(self::ENDPOINT, null, new NativeParser(), new NativeSerializer());

        return new WuBookCorporate($this->config, $this->cache, $client, $token);
    }

    /**
     * Extra functions API
     *
     * @param string $token
     * @return AND48\LaravelWubook\Api\WuBookExtras
     */
    public function extras($token = null)
    {
        // Setup client
        $client = new Client(self::ENDPOINT, null, new NativeParser(), new NativeSerializer());

        return new WuBookExtras($this->config, $this->cache, $client, $token);
    }

    /**
     * Prices API
     *
     * @param string $token
     * @return AND48\LaravelWubook\Api\WuBookPrices
     */
    public function prices($token = null)
    {
        // Setup client
        $client = new Client(self::ENDPOINT, null, new NativeParser(), new NativeSerializer());

        return new WuBookPrices($this->config, $this->cache, $client, $token);
    }

    /**
     * Reservations API
     *
     * @param string $token
     * @return AND48\LaravelWubook\Api\WuBookPrices
     */
    public function reservations($token = null)
    {
        // Setup client
        $client = new Client(self::ENDPOINT, null, new NativeParser(), new NativeSerializer());

        return new WuBookReservations($this->config, $this->cache, $client, $token);
    }

    /**
     * Restrictions API
     *
     * @param string $token
     * @return AND48\LaravelWubook\Api\WuBookRestrictions
     */
    public function restrictions($token = null)
    {
        // Setup client
        $client = new Client(self::ENDPOINT, null, new NativeParser(), new NativeSerializer());

        return new WuBookRestrictions($this->config, $this->cache, $client, $token);
    }

    /**
     * Rooms API
     *
     * @param string $token
     * @return AND48\LaravelWubook\Api\WuBookRooms
     */
    public function rooms($credentials)
    {
        return new WuBookRooms($credentials, $this->client);
    }

    /**
     * Transactions API
     *
     * @param string $token
     * @return AND48\LaravelWubook\Api\WuBookTransactions
     */
    public function transactions($token = null)
    {
        // Setup client
        $client = new Client(self::ENDPOINT, null, new NativeParser(), new NativeSerializer());

        return new WuBookTransactions($this->config, $this->cache, $client, $token);
    }

    /**
     * Username getter.
     *
     * @return string
     */
    public function get_username()
    {
        return $this->username;
    }

    /**
     * Password getter.
     *
     * @return string
     */
    public function get_password()
    {
        return $this->password;
    }

    /**
     * Provider key getter.
     *
     * @return string
     */
    public function get_provider_key()
    {
        return $this->provider_key;
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
