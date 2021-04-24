<?php

namespace App\Services;

use App\Models\Order;

class OrderService implements OrderServiceInterface
{
    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * get list
     *
     * @return void
     */
    public function getListOrder($params)
    {
        $query = $this->order->orderByDesc('created_at')->paginate();
        return [
            'data' => $query->map(function ($item) {
                return $item->getOrderResponse();
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
    public function getAllOrder($params)
    {
        $query = $this->order->orderByDesc('created_at');
        return $query->get()->map(function ($item) {
            return $item->getOrderResponse();
        });
    }

    /**
     * create
     *
     * @param array $params
     * @return void
     */
    public function createOrder($params)
    {
        return $this->order->create([
            'total' => $params['total'],
            'status' => $params['status'],
            'payment_method' => $params['payment_method'],
            'payment_type' => $params['payment_type'],
            'user_id' => $params['user_id'],
        ]);
    }

    /**
     * delete
     *
     * @param $id
     * @return void
     */
    public function deleteOrder($id)
    {
        $this->order->findOrFail($id)->delete();
    }

    /**
     * show
     *
     * @param $id
     * @return void
     */
    public function showOrder($id)
    {
        return $this->order->findOrFail($id)->getOrderResponse();
    }

    /**
     * edit
     *
     * @param array $params
     * @return void
     */
    public function updateOrder($params)
    {
        $this->order->findOrFail($params['id'])->update($params);
    }
}
