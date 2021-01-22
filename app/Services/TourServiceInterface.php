<?php

namespace App\Services;

interface TourServiceInterface
{
    public function getListTour($params);

    public function getAllTour($params);

    public function createTour($params);

    public function deleteTour($id);

    public function showTour($id);

    public function updateTour($params);
}