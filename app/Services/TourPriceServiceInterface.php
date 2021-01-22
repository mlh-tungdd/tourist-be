<?php

namespace App\Services;

interface TourPriceServiceInterface
{
    public function getListTourPrice($params);

    public function getAllTourPrice($params);

    public function createTourPrice($params);

    public function deleteTourPrice($id);

    public function showTourPrice($id);

    public function updateTourPrice($params);

    public function getListTourPriceByTourId($tourId);
}