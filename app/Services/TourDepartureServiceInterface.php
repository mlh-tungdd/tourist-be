<?php

namespace App\Services;

interface TourDepartureServiceInterface
{
    public function getListTourDeparture($params);

    public function getAllTourDeparture($params);

    public function createTourDeparture($params);

    public function deleteTourDeparture($id);

    public function showTourDeparture($id);

    public function updateTourDeparture($params);

    public function getListTourDepartureByTourId($tourId);

    public function createTourDepartureOption($params);

    public function updateTourDepartureOption($params);
}
