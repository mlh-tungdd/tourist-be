<?php

namespace App\Services;

use App\Models\Location;

class LocationService implements LocationServiceInterface
{
    protected $location;

    public function __construct(Location $location)
    {
        $this->location = $location;
    }

    /**
     * get list
     *
     * @return void
     */
    public function getListLocation($params)
    {
        $query = $this->location->orderByDesc('created_at')->paginate();
        return [
            'data' => $query->map(function ($item) {
                return $item->getLocationResponse();
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
    public function getAllLocation($params)
    {
        $query = $this->location->orderByDesc('created_at');
        $type = $params['type'] ?? null;
        $destination = $params['destination'] ?? null;

        if ($type != null) {
            $query->where('type', $type);
        }
        if ($destination != null) {
            $query->where('is_departure', $destination);
        }
        return $query->get()->map(function ($item) {
            return $item->getLocationResponse();
        });
    }

    /**
     * create
     *
     * @param array $params
     * @return void
     */
    public function createLocation($params)
    {
        $this->location->create([
            'regions' => $params['regions'],
            'city' => $params['city'],
            'description' => $params['description'],
            'content' => $params['content'],
            'thumbnail' => $params['thumbnail'],
            'type' => $params['type'],
            'is_departure' => $params['is_departure'],
        ]);
    }

    /**
     * delete
     *
     * @param $id
     * @return void
     */
    public function deleteLocation($id)
    {
        $this->location->findOrFail($id)->delete();
    }

    /**
     * show
     *
     * @param $id
     * @return void
     */
    public function showLocation($id)
    {
        return $this->location->findOrFail($id)->getLocationResponse();
    }

    /**
     * edit
     *
     * @param array $params
     * @return void
     */
    public function updateLocation($params)
    {
        $this->location->findOrFail($params['id'])->update($params);
    }
}
