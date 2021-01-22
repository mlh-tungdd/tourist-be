<?php

namespace App\Services;

interface TourImageServiceInterface
{
    public function getListTourImage($params);

    public function getAllTourImage($params);

    public function createTourImage($params);

    public function deleteTourImage($id);

    public function showTourImage($id);

    public function updateTourImage($params);

    public function getListTourImageByTourId($tourId);
}