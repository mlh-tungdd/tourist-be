<?php

namespace App\Services;

interface HotelServiceInterface
{
    public function getListHotel($params);

    public function getAllHotel($params);

    public function createHotel($params);

    public function deleteHotel($id);

    public function showHotel($id);

    public function updateHotel($params);
}
