<?php

namespace App\Services;

interface BookingDetailServiceInterface
{
    public function getAllBookingDetail($params);

    public function createBookingDetail($params);
}
