<?php

namespace App\Services;

use App\Models\BookingDetail;

class BookingDetailService implements BookingDetailServiceInterface
{
    protected $bookingDetail;

    public function __construct(BookingDetail $bookingDetail)
    {
        $this->bookingDetail = $bookingDetail;
    }

    /**
     * get all
     *
     * @return void
     */
    public function getAllBookingDetail($params)
    {
        $query = $this->bookingDetail->bookingDetailByDesc('created_at');
        return $query->get()->map(function ($item) {
            return $item->getBookingDetailResponse();
        });
    }

    /**
     * create
     *
     * @param array $params
     * @return void
     */
    public function createBookingDetail($params)
    {
        return $this->bookingDetail->create([
            'start_day' => $params['start_day'],
            'end_day' => $params['end_day'],
            'qty' => $params['qty'],
            'price' => $params['price'],
            'booking_id' => $params['booking_id'],
            'room_id' => $params['room_id'],
            'hotel_id' => $params['hotel_id'],
        ]);
    }
}
