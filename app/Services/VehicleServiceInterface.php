<?php

namespace App\Services;

interface VehicleServiceInterface
{
    public function getListVehicle($params);

    public function getAllVehicle($params);

    public function createVehicle($params);

    public function deleteVehicle($id);

    public function showVehicle($id);

    public function updateVehicle($params);
}