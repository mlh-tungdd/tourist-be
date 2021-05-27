<?php

namespace App\Services;

use App\Models\Room;

class RoomService implements RoomServiceInterface
{
    protected $room;

    public function __construct(Room $room)
    {
        $this->room = $room;
    }

    /**
     * get list
     *
     * @return void
     */
    public function getListRoom($hotelId)
    {
        $query = $this->room->where('hotel_id', $hotelId)->orderByDesc('created_at')->paginate();

        return [
            'data' => $query->map(function ($item) {
                return $item->getRoomResponse();
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
    public function getAllRoomByHotelId($params)
    {
        $id = $params['id'];
        $query = $this->room->where("hotel_id", $id)->orderByDesc('created_at');
        return $query->get()->map(function ($item) {
            return $item->getRoomResponse();
        });
    }

    /**
     * create
     *
     * @param array $params
     * @return void
     */
    public function createRoom($params)
    {
        $this->room->create([
            'thumbnail' => $params['thumbnail'],
            'name' => $params['name'],
            'area' => $params['area'],
            'space' => $params['space'],
            'position' => $params['position'],
            'options' => $params['options'],
            'price' => $params['price'],
            'qty' => $params['qty'],
            'note' => $params['note'],
            'convenients' => $params['convenients'],
            'hotel_id' => $params['hotel_id'],
        ]);
    }

    /**
     * delete
     *
     * @param $id
     * @return void
     */
    public function deleteRoom($id)
    {
        $this->room->findOrFail($id)->delete();
    }

    /**
     * show
     *
     * @param $id
     * @return void
     */
    public function showRoom($id)
    {
        return $this->room->findOrFail($id)->getRoomResponse();
    }

    /**
     * edit
     *
     * @param array $params
     * @return void
     */
    public function updateRoom($params)
    {
        $this->room->findOrFail($params['id'])->update($params);
    }
}
