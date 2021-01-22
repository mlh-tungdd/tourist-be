<?php

namespace App\Services;

use App\Models\Tour;

class TourService implements TourServiceInterface
{
    protected $tour;

    public function __construct(Tour $tour)
    {
        $this->tour = $tour;
    }

    /**
     * get list
     *
     * @return void
     */
    public function getListTour($params)
    {
        $query = $this->tour->with(['time', 'departure', 'destination', 'vehicle'])->orderByDesc('created_at')->paginate();
        return [
            'data' => $query->map(function ($item) {
                return $item->getTourResponse();
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
    public function getAllTour($params)
    {
        $query = $this->tour->orderByDesc('created_at');
        return $query->get()->map(function ($item) {
            return $item->getTourResponse();
        });
    }

    /**
     * create
     *
     * @param array $params
     * @return void
     */
    public function createTour($params)
    {
        $this->tour->create([
            'roll_number' => $params['roll_number'],
            'title' => $params['title'],
            'description' => $params['description'],
            'content' => $params['content'],
            'schedule' => $params['schedule'],
            'term' => $params['term'],
            'thumbnail' => $params['thumbnail'],
            'space' => $params['space'],
            'time_id' => $params['time_id'],
            'vehicle_id' => $params['vehicle_id'],
            'departure_id' => $params['departure_id'],
            'destination_id' => $params['destination_id'],
        ]);
    }

    /**
     * delete
     *
     * @param $id
     * @return void
     */
    public function deleteTour($id)
    {
        $this->tour->findOrFail($id)->delete();
    }

    /**
     * show
     *
     * @param $id
     * @return void
     */
    public function showTour($id)
    {
        return $this->tour->findOrFail($id);
    }

    /**
     * edit
     *
     * @param array $params
     * @return void
     */
    public function updateTour($params)
    {
        $this->tour->findOrFail($params['id'])->update($params);
    }
}