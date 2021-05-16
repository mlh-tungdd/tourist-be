<?php

namespace App\Services;

interface RateServiceInterface
{
    public function getListRate($tourId);

    public function getAllRate($params);

    public function createRate($params);

    public function deleteRate($id);

    public function showRate($id);

    public function updateRate($params);
}
