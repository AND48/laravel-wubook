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


/**
 * This is the WuBook rooms api class.
 *
 * @author Filippo Galante <filippo.galante@b-ground.com>
 */
class WuBookRooms extends WuBookApi
{

    /**
     * https://tdocs.wubook.net/wired/rooms.html#fetch_rooms
     *
     * @param int $ancillary 0|1
     * @return mixed
     */
    public function fetch_rooms(int $ancillary = 0)
    {
        return $this->call_method( 'fetch_rooms', ['ancillary' => $ancillary]);
    }

    /**
     * http://tdocs.wubook.net/wired/rooms.html#new_room
     * http://tdocs.wubook.net/wired/rooms.html#new_virtual_room
     *
     * @param array $data
     * @return mixed
     */
    public function new_room($data, $virtual = false)
    {
        if ($virtual) {
            return $this->call_method('new_virtual_room', $data);
        } else {
            return $this->call_method( 'new_room', $data);
        }
    }

    /**
     * http://tdocs.wubook.net/wired/rooms.html#mod_room
     * http://tdocs.wubook.net/wired/rooms.html#mod_virtual_room
     *
     * The method will return a boolean only if response has no error.
     *
     * @param array $data
     * @param array|boolean $virtual
     * @return mixed
     */
    public function mod_room($data, $virtual = false)
    {
        if ($virtual) {
            return $this->call_method('mod_virtual_room', $data);
        } else {
            return $this->call_method('mod_room', $data);
        }
    }

    /**
     * http://tdocs.wubook.net/wired/rooms.html#del_room
     *
     * The method will return a boolean only if response has no error.
     *
     * @param int $id
     * @return boolean|string
     */
    public function del_room($id)
    {
        return $this->call_method('del_room', [$id]);
    }

    /**
     * http://tdocs.wubook.net/wired/rooms.html#room_images
     *
     * @param int $id
     * @return mixed
     */
    public function room_images($id)
    {
        return $this->call_method('room_images', [$id]);
    }

    /**
     * http://tdocs.wubook.net/wired/rooms.html#push_update_activation
     *
     * The method will return a boolean only if response has no error.
     *
     * @param string $url
     * @return boolean|string
     */
    public function push_update_activation($url)
    {
        return $this->call_method('push_update_activation', [$url]);
    }

    /**
     * http://tdocs.wubook.net/wired/rooms.html#push_update_url
     *
     * @return string
     */
    public function push_update_url()
    {
        return $this->call_method('push_update_url');
    }
}
