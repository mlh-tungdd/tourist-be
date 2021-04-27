<?php

namespace App\Services;

use App\Models\Location;
use App\Models\Time;

class LocationService implements LocationServiceInterface
{
    protected $location;
    protected $time;

    public function __construct(Location $location, Time $time)
    {
        $this->location = $location;
        $this->time = $time;
    }

    /**
     * get list
     *
     * @return void
     */
    public function getListLocation($params)
    {
        $query = $this->location->orderByDesc('created_at');
        $city = $params['city'] ?? null;
        $regions = $params['regions'] ?? null;
        $type = $params['type'] ?? null;
        $isDeparture = $params['is_departure'] ?? null;

        if ($city != null) {
            $query->where('city', 'like', '%' . $city . '%');
        }

        if ($regions != null) {
            $query->where("regions", $regions);
        }

        if ($type != null) {
            $query->where("type", $type);
        }

        if ($isDeparture != null) {
            $query->where("is_departure", $isDeparture);
        }

        $query = $query->paginate();

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

    /**
     *
     */
    public function getListNavigationClient()
    {
        return [
            "NORTHERN" => $this->location->where("regions", 1)->get(),
            "CENTRAL" => $this->location->where("regions", 2)->get(),
            "SOUTH" => $this->location->where("regions", 3)->get(),
            "ASIA" => $this->location->where("regions", 4)->get(),
            "EUROPE" => $this->location->where("regions", 5)->get(),
            "AMERICAS" => $this->location->where("regions", 6)->get(),
            "OTHER" => $this->location->where("regions", 7)->get(),
        ];
    }

    /**
     *
     */
    public function getFilterClient()
    {
        return [
            "departures" => $this->location->where("is_departure", 1)->get(),
            "nations" => $this->location->where("type", 0)->get(),
            "foreigns" => $this->location->where("type", 1)->get(),
            "times" => $this->time->get(),
        ];
    }
}
