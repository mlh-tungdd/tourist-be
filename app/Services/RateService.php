<?php

namespace App\Services;

use App\Models\Rate;

class RateService implements RateServiceInterface
{
    protected $rate;

    public function __construct(Rate $rate)
    {
        $this->rate = $rate;
    }

    /**
     * get list
     *
     * @return void
     */
    public function getListRate($tourId)
    {
        $query = $this->rate->where('tour_id', $tourId)->orderByDesc('created_at')->paginate();
        return [
            'data' => $query->map(function ($item) {
                return $item->getRateResponse();
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
    public function getAllRate($params)
    {
        $query = $this->rate->orderByDesc('created_at')->get();
        return $query->map(function ($item) {
            return $item->getRateResponse();
        });
    }

    /**
     * create
     *
     * @param array $params
     * @return void
     */
    public function createRate($params)
    {
        $this->rate->create([
            'rate' => $params['rate'],
            'content' => $params['content'],
            'user_id' => $params['user_id'],
            'tour_id' => $params['tour_id'],
        ]);
    }

    /**
     * delete
     *
     * @param $id
     * @return void
     */
    public function deleteRate($id)
    {
        $this->rate->findOrFail($id)->delete();
    }

    /**
     * show
     *
     * @param $id
     * @return void
     */
    public function showRate($id)
    {
        return $this->rate->findOrFail($id)->getRateResponse();
    }

    /**
     * edit
     *
     * @param array $params
     * @return void
     */
    public function updateRate($params)
    {
        $this->rate->findOrFail($params['id'])->update($params);
    }
}
