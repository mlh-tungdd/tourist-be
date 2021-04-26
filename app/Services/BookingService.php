<?php

namespace App\Services;

use App\Models\Booking;

class BookingService implements BookingServiceInterface
{
    protected $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    /**
     * get list
     *
     * @return void
     */
    public function getListBooking($params)
    {
        $query = $this->booking->orderByDesc('created_at')->paginate();
        return [
            'data' => $query->map(function ($item) {
                return $item->getBookingResponse();
            }),
            'per_page' => $query->perPage(),
            'total' => $query->total(),
            'current_page' => $query->currentPage(),
            'last_page' => $query->lastPage(),
        ];
    }

    /**
     * get all
     *
     * @return void
     */
    public function getAllBooking($params)
    {
        $query = $this->booking->orderByDesc('created_at');
        return $query->get()->map(function ($item) {
            return $item->getBookingResponse();
        });
    }

    /**
     * create
     *
     * @param array $params
     * @return void
     */
    public function createBooking($params)
    {
        return $this->booking->create([
            'total' => $params['total'],
            'status' => $params['status'],
            'user_id' => $params['user_id'],
        ]);
    }

    /**
     * delete
     *
     * @param $id
     * @return void
     */
    public function deleteBooking($id)
    {
        $this->booking->findOrFail($id)->delete();
    }

    /**
     * show
     *
     * @param $id
     * @return void
     */
    public function showBooking($id)
    {
        return $this->booking->findOrFail($id)->getBookingResponse();
    }

    /**
     * edit
     *
     * @param array $params
     * @return void
     */
    public function updateBooking($params)
    {
        $this->booking->findOrFail($params['id'])->update($params);
    }
}
