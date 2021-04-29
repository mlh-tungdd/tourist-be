<?php

namespace App\Services;

use App\Models\Hotel;

class HotelService implements HotelServiceInterface
{
    protected $hotel;

    public function __construct(Hotel $hotel)
    {
        $this->hotel = $hotel;
    }

    /**
     * get list
     *
     * @return void
     */
    public function getListHotel($params)
    {
        $query = $this->hotel->orderByDesc('created_at');
        $location = $params['location_id'] ?? null;
        $star = $params['star'] ?? null;
        $name = $params['name'] ?? null;

        if ($location != null) {
            $query->where("location_id", $location);
        }

        if ($star != null) {
            $query->where("star", $star);
        }

        if ($name != null) {
            $query->where('name', 'like', '%' . $name . '%');
        }

        $query = $query->paginate();

        return [
            'data' => $query->map(function ($item) {
                return $item->getHotelResponse();
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
    public function getAllHotel($params)
    {
        $query = $this->hotel->orderByDesc('created_at');
        return $query->get()->map(function ($item) {
            return $item->getHotelResponse();
        });
    }

    /**
     * create
     *
     * @param array $params
     * @return void
     */
    public function createHotel($params)
    {
        $this->hotel->create([
            'name' => $params['name'],
            'address' => $params['address'],
            'description' => $params['description'],
            'content' => $params['content'],
            'star' => $params['star'],
            'active' => $params['active'],
            'thumbnail' => $params['thumbnail'],
            'from_price' => $params['from_price'],
            'location_id' => $params['location_id'],
        ]);
    }

    /**
     * delete
     *
     * @param $id
     * @return void
     */
    public function deleteHotel($id)
    {
        $this->hotel->findOrFail($id)->delete();
    }

    /**
     * show
     *
     * @param $id
     * @return void
     */
    public function showHotel($id)
    {
        return $this->hotel->findOrFail($id)->getHotelResponse();
    }

    /**
     * edit
     *
     * @param array $params
     * @return void
     */
    public function updateHotel($params)
    {
        $this->hotel->findOrFail($params['id'])->update($params);
    }
}
