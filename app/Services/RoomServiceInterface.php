<?php

namespace App\Services;

interface RoomServiceInterface
{
    public function getAllRoomByHotelId($params);

    public function createRoom($params);

    public function deleteRoom($id);

    public function showRoom($id);

    public function updateRoom($params);

    public function getListRoom($hotelId);
}
