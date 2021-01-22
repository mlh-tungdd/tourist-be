<?php

namespace App\Services;

use App\Models\Vehicle;

class VehicleService implements VehicleServiceInterface
{
    protected $vehicle;

    public function __construct(Vehicle $vehicle)
    {
        $this->vehicle = $vehicle;
    }

    /**
     * get list
     *
     * @return void
     */
    public function getListVehicle($params)
    {
        $query = $this->vehicle->orderByDesc('created_at')->paginate();
        return [
            'data' => $query->map(function ($item) {
                return $item->getVehicleResponse();
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
    public function getAllVehicle($params)
    {
        $query = $this->vehicle->orderByDesc('created_at')->get();
        return $query->map(function ($item) {
            return $item->getVehicleResponse();
        });
    }

    /**
     * create
     *
     * @param array $params
     * @return void
     */
    public function createVehicle($params)
    {
        $this->vehicle->create([
            'title' => $params['title'],
        ]);
    }

    /**
     * delete
     *
     * @param $id
     * @return void
     */
    public function deleteVehicle($id)
    {
        $this->vehicle->findOrFail($id)->delete();
    }

    /**
     * show
     *
     * @param $id
     * @return void
     */
    public function showVehicle($id)
    {
        return $this->vehicle->findOrFail($id);
    }

    /**
     * edit
     *
     * @param array $params
     * @return void
     */
    public function updateVehicle($params)
    {
        $this->vehicle->findOrFail($params['id'])->update($params);
    }
}