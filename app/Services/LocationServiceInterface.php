<?php

namespace App\Services;

interface LocationServiceInterface
{
    public function getListLocation($params);

    public function getAllLocation($params);

    public function createLocation($params);

    public function deleteLocation($id);

    public function showLocation($id);

    public function updateLocation($params);

    public function getListNavigationClient();

    public function getFilterClient();
}
