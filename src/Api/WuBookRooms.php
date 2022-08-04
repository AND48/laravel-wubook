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
use Illuminate\Support\Facades\Validator;

/**
 * This is the WuBook rooms api class.
 *
 * @author Filippo Galante <filippo.galante@b-ground.com>
 */
class WuBookRooms extends WuBookApi
{
    private function checkNewRoomData($data){

        $validator = Validator::make($data, [
            'woodoo' => 'required|in:0,1',
            'name' => 'required',
            'beds' => 'required|integer|min:1',
            'defprice' => 'required|numeric|min:0',
            'avail' => 'required|integer|min:0',
            'shortname' => 'required|max:4',
            'defboard' => 'required|in:bb,fb,hb,nb,ai',
        ]);
        if ($validator->fails()) {
            throw new WuBookException($validator->errors());
        }

        return [
            $data['woodoo'],
            $data['name'],
            $data['beds'],
            $data['defprice'],
            $data['avail'],
            $data['shortname'],
            $data['defboard'],
        ];
    }

    private function checkModRoomData($data){

        $validator = Validator::make($data, [
            'name' => 'required',
            'beds' => 'required|integer|min:1',
            'defprice' => 'required|numeric|min:0',
            'avail' => 'required|integer|min:0',
            'shortname' => 'required|max:4',
            'defboard' => 'required|in:bb,fb,hb,nb,ai',
        ]);
        if ($validator->fails()) {
            throw new WuBookException($validator->errors());
        }

        return [
            $data['name'],
            $data['beds'],
            $data['defprice'],
            $data['avail'],
            $data['shortname'],
            $data['defboard'],
        ];
    }

    /**
     * https://tdocs.wubook.net/wired/rooms.html#fetch_rooms
     *
     * @param int $ancillary 0|1
     * @return mixed
     */
    public function fetch_rooms(int $ancillary = 0)
    {
        return $this->call_method( 'fetch_rooms', [$ancillary]);
    }

    /**
     * https://tdocs.wubook.net/wired/rooms.html#fetch_single_room
     *
     * @param int $ancillary 0|1
     * @param int $id
     * @return mixed
     */
    public function fetch_single_room(int $id, int $ancillary = 0)
    {
        return $this->call_method( 'fetch_single_room', [$id, $ancillary]);
    }

    /**
     * https://tdocs.wubook.net/wired/rooms.html#new_room
     *
     * @param array $data
     * @return mixed
     */
    public function new_room(array $data)
    {
        return $this->call_method('new_room', $this->checkNewRoomData($data));
    }



    /**
     * https://tdocs.wubook.net/wired/rooms.html#mod_room
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function mod_room(int $id, array $data)
    {
        $data = $this->checkModRoomData($data);
        array_unshift($data, $id);
        return $this->call_method('mod_room', $data);
    }

    /**
     * https://tdocs.wubook.net/wired/rooms.html#del_room
     *
     * @param int $id
     * @return mixed
     */
    public function del_room(int $id)
    {
        return $this->call_method('del_room', [$id]);
    }

}
