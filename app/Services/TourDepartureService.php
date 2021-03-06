<?php

namespace App\Services;

use App\Models\TourDeparture;

class TourDepartureService implements TourDepartureServiceInterface
{
    protected $tourDeparture;

    public function __construct(TourDeparture $tourDeparture)
    {
        $this->tourDeparture = $tourDeparture;
    }

    /**
     * get list
     *
     * @return void
     */
    public function getListTourDeparture($params)
    {
        $query = $this->tourDeparture->with(['tour'])->select('tour_id')->groupBy('tour_id')->paginate();
        return [
            'data' => $query->map(function ($item) {
                return $item->getTourDepartureResponse();
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
    public function getAllTourDeparture($params)
    {
        $query = $this->tourDeparture->get();
        return $query->map(function ($item) {
            return $item->getTourDepartureResponse();
        });
    }

    /**
     * create
     *
     * @param array $params
     * @return void
     */
    public function createTourDeparture($params)
    {
        $tourId = $params['tour_id'];
        $departures = $params['departures'];
        foreach ($departures as $value) {
            $this->tourDeparture->create([
                'start_day' => $value['start_day'],
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
    public function deleteTourDeparture($id)
    {
        $this->tourDeparture->findOrFail($id)->delete();
    }

    /**
     * show
     *
     * @param $id
     * @return void
     */
    public function showTourDeparture($id)
    {
        return $this->tourDeparture->findOrFail($id);
    }

    /**
     * edit
     *
     * @param array $params
     * @return void
     */
    public function updateTourDeparture($params)
    {
        $departuresRemove = $params['departures_remove'];
        $departures = $params['departures'];

        foreach ($departures as $value) {
            $this->tourDeparture->findOrFail($value['id'])->update([
                'start_day' => $value['start_day'],
            ]);
        }

        foreach ($departuresRemove as $id) {
            $this->tourDeparture->findOrFail($id)->delete();
        }
    }

    /**
     * get by tour id
     *
     * @param array $params
     * @return void
     */
    public function getListTourDepartureByTourId($tourId)
    {
        $query = $this->tourDeparture->where('tour_id', $tourId)->orderByDesc('created_at')->get();
        return $query->map(function ($item) {
            return $item->getTourDepartureResponseByTourId();
        });
    }

    /**
     * create
     *
     * @param array $params
     * @return void
     */
    public function createTourDepartureOption($params)
    {
        $this->tourDeparture->create([
            'tour_id' => $params['tour_id'],
            'start_day' => $params['start_day'],
        ]);
    }

    /**
     * edit
     *
     * @param array $params
     * @return void
     */
    public function updateTourDepartureOption($params)
    {
        $this->tourDeparture->findOrFail($params['id'])->update($params);
    }
}
