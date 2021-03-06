<?php

namespace App\Services;

use App\Models\TourSchedule;

class TourScheduleService implements TourScheduleServiceInterface
{
    protected $tourSchedule;

    public function __construct(TourSchedule $tourSchedule)
    {
        $this->tourSchedule = $tourSchedule;
    }

    /**
     * get list
     *
     * @return void
     */
    public function getListTourSchedule($params)
    {
        $query = $this->tourSchedule->with(['tour'])->select('tour_id')->groupBy('tour_id')->paginate();
        return [
            'data' => $query->map(function ($item) {
                return $item->getTourScheduleResponse();
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
    public function getAllTourSchedule($params)
    {
        $query = $this->tourSchedule->get();
        return $query->map(function ($item) {
            return $item->getTourScheduleResponse();
        });
    }

    /**
     * create
     *
     * @param array $params
     * @return void
     */
    public function createTourSchedule($params)
    {
        $tourId = $params['tour_id'];
        $schedules = $params['schedules'];
        foreach ($schedules as $value) {
            $this->tourSchedule->create([
                'title' => $value['title'],
                'content' => $value['content'],
                'day_number' => $value['day_number'],
                'tour_id' => $tourId,
            ]);
        }
    }

    /**
     * delete
     *
     * @param $id
     * @return void
     */
    public function deleteTourSchedule($id)
    {
        $this->tourSchedule->findOrFail($id)->delete();
    }

    /**
     * show
     *
     * @param $id
     * @return void
     */
    public function showTourSchedule($id)
    {
        return $this->tourSchedule->findOrFail($id);
    }

    /**
     * edit
     *
     * @param array $params
     * @return void
     */
    public function updateTourSchedule($params)
    {
        $schedulesRemove = $params['schedules_remove'];
        $schedules = $params['schedules'] ?? [];

        foreach ($schedules as $value) {
            $this->tourSchedule->findOrFail($value['id'])->update([
                'title' => $value['title'],
                'content' => $value['content'],
                'day_number' => $value['day_number'],
            ]);
        }

        foreach ($schedulesRemove as $id) {
            $this->tourSchedule->findOrFail($id)->delete();
        }
    }

    /**
     * get by tour id
     *
     * @param array $params
     * @return void
     */
    public function getListTourScheduleByTourId($tourId)
    {
        $query = $this->tourSchedule->where('tour_id', $tourId)->orderBy('created_at')->get();
        return $query->map(function ($item) {
            return $item->getTourScheduleResponseByTourId();
        });
    }

    /**
     * create
     *
     * @param array $params
     * @return void
     */
    public function createTourScheduleOption($params)
    {
        $this->tourSchedule->create([
            'tour_id' => $params['tour_id'],
            'title' => $params['title'],
            'content' => $params['content'],
            'day_number' => $params['day_number'],
        ]);
    }

    /**
     * edit
     *
     * @param array $params
     * @return void
     */
    public function updateTourScheduleOption($params)
    {
        $this->tourSchedule->findOrFail($params['id'])->update($params);
    }
}
