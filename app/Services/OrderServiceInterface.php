<?php

namespace App\Services;

interface OrderServiceInterface
{
    public function getListOrder($params);

    public function getAllOrder($params);

    public function createOrder($params);

    public function deleteOrder($id);

    public function showOrder($id);

    public function updateOrder($params);
}
