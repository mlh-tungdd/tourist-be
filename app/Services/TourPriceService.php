<?php

namespace App\Services;

use App\Models\TourPrice;

class TourPriceService implements TourPriceServiceInterface
{
    protected $tourPrice;

    public function __construct(TourPrice $tourPrice)
    {
        $this->tourPrice = $tourPrice;
    }

    /**
     * get list
     *
     * @return void
     */
    public function getListTourPrice($params)
    {
        $query = $this->tourPrice->with(['tour'])->select('tour_id')->groupBy('tour_id')->paginate();
        return [
            'data' => $query->map(function ($item) {
                return $item->getTourPriceResponse();
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
    public function getAllTourPrice($params)
    {
        $query = $this->tourPrice->get();
        return $query->map(function ($item) {
            return $item->getTourPriceResponse();
        });
    }

    /**
     * create
     *
     * @param array $params
     * @return void
     */
    public function createTourPrice($params)
    {
        $tourId = $params['tour_id'];
        $prices = $params['prices'];
        foreach ($prices as $value) {
            $this->tourPrice->create([
                'type_customer' => $value['type_customer'],
                'original_price' => $value['original_price'],
                'price' => $value['price'],
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
    public function deleteTourPrice($id)
    {
        $this->tourPrice->findOrFail($id)->delete();
    }

    /**
     * show
     *
     * @param $id
     * @return void
     */
    public function showTourPrice($id)
    {
        return $this->tourPrice->findOrFail($id);
    }

    /**
     * edit
     *
     * @param array $params
     * @return void
     */
    public function updateTourPrice($params)
    {
        $pricesRemove = $params['prices_remove'];
        $prices = $params['prices'];

        foreach ($prices as $value) {
            $this->tourPrice->findOrFail($value['_id'])->update([
                'type_customer' => $value['type_customer'],
                'original_price' => $value['original_price'],
                'price' => $value['price'],
            ]);
        }

        foreach ($pricesRemove as $id) {
            $this->tourPrice->findOrFail($id)->delete();
        }
    }

    /**
     * get by tour id
     *
     * @param array $params
     * @return void
     */
    public function getListTourPriceByTourId($tourId)
    {
        $query = $this->tourPrice->where('tour_id', $tourId)->orderByDesc('created_at')->get();
        return $query->map(function ($item) {
            return $item->getTourPriceResponseByTourId();
        });
    }
}
