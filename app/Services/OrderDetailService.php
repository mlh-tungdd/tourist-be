<?php

namespace App\Services;

use App\Models\OrderDetail;

class OrderDetailService implements OrderDetailServiceInterface
{
    protected $orderDetail;

    public function __construct(OrderDetail $orderDetail)
    {
        $this->orderDetail = $orderDetail;
    }

    /**
     * get all
     *
     * @return void
     */
    public function getAllOrderDetail($params)
    {
        $query = $this->orderDetail->orderDetailByDesc('created_at');
        return $query->get()->map(function ($item) {
            return $item->getOrderDetailResponse();
        });
    }

    /**
     * create
     *
     * @param array $params
     * @return void
     */
    public function createOrderDetail($params)
    {
        return $this->orderDetail->create([
            'departure_id' => $params['departure_id'],
            'price_id' => $params['price_id'],
            'qty' => $params['qty'],
            'price' => $params['price'],
            'type_customer' => $params['type_customer'],
            'order_id' => $params['order_id'],
            'tour_id' => $params['tour_id'],
        ]);
    }
}
