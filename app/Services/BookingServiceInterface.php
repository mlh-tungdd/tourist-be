<?php

namespace App\Services;

interface BookingServiceInterface
{
    public function getListBooking($params);

    public function getAllBooking($params);

    public function createBooking($params);

    public function deleteBooking($id);

    public function showBooking($id);

    public function updateBooking($params);
}
