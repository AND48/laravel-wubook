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

use AND48\LaravelWubook\Exceptions\WuBookException;
use Carbon\Carbon;
use fXmlRpc\Client;

/**
 * This is the WuBook api abstract class.
 *
 * @author ilgala
 */
abstract class WuBookApi
{

    /**
     * @var array
     */
    protected $config;

    /**
     * @var fXmlRpc\Client
     */
    protected $client;


    /**
     * Creates a new WuBookAuth instance.
     *
     * @param array $config
     * @param fXmlRpc\Client $client
     */
    public function __construct(array $config, Client $client)
    {
        $this->config = $config;
        $this->client = $client;
    }

    /**
     * Calls a wired API function.
     *
     * @param string $method
     * @param array $data
     * @return array
     * @throws WuBookException
     */
    protected function call_method($method, $data = [])
    {
        // Credentials check
        if (!array_key_exists('lcode', $this->config) || !array_key_exists('token', $this->config)) {
            throw new WuBookException('Credentials are required!');
        }

        $data = array_values(array_merge([$this->config['token'], $this->config['lcode']], $data));

        try {
            // Retrieve response
            $response = $this->client->call($method, $data);
            return [
                'has_error' => $response[0] != 0,
                'code' => $response[0],
                'data' => $response[1]
            ];
        } catch (AbstractTransportException $error) {
            throw new WuBookException($error->getMessage(), $error->getCode(), $error);
        }
    }

    public function formatDate(Carbon $date)
    {
        return $date->format('d/m/Y');
    }
}
