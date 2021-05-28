<?php

namespace App\Services;

use App\Models\Discount;
use Carbon\Carbon;

class DiscountService implements DiscountServiceInterface
{
    protected $discount;

    public function __construct(Discount $discount)
    {
        $this->discount = $discount;
    }

    /**
     * get list
     *
     * @return void
     */
    public function getListDiscount($params)
    {
        $query = $this->discount->orderByDesc('created_at')->paginate();
        return [
            'data' => $query->map(function ($item) {
                return $item->getDiscountResponse();
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
    public function getAllDiscount($params)
    {
        $now = Carbon::now();
        $query = $this->discount->whereDate('publish_at', '<=', $now)->whereDate('closed_at', '>=', $now)->orderByDesc('created_at')->get();
        return $query->map(function ($item) {
            return $item->getDiscountResponse();
        });
    }

    /**
     * create
     *
     * @param array $params
     * @return void
     */
    public function createDiscount($params)
    {
        $this->discount->create([
            'code' => $params['code'],
            'discount' => $params['discount'],
            'publish_at' => $params['publish_at'],
            'closed_at' => $params['closed_at'],
        ]);
    }

    /**
     * delete
     *
     * @param $id
     * @return void
     */
    public function deleteDiscount($id)
    {
        $this->discount->findOrFail($id)->delete();
    }

    /**
     * show
     *
     * @param $id
     * @return void
     */
    public function showDiscount($id)
    {
        return $this->discount->findOrFail($id)->getDiscountResponse();
    }

    /**
     * edit
     *
     * @param array $params
     * @return void
     */
    public function updateDiscount($params)
    {
        $this->discount->findOrFail($params['id'])->update($params);
    }
}
