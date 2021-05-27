<?php

namespace App\Services;

interface TourScheduleServiceInterface
{
    public function getListTourSchedule($params);

    public function getAllTourSchedule($params);

    public function createTourSchedule($params);

    public function deleteTourSchedule($id);

    public function showTourSchedule($id);

    public function updateTourSchedule($params);

    public function getListTourScheduleByTourId($tourId);

    public function createTourScheduleOption($params);

    public function updateTourScheduleOption($params);
}
