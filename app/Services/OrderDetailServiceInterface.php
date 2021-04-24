<?php

namespace App\Services;

interface OrderDetailServiceInterface
{
    public function getAllOrderDetail($params);

    public function createOrderDetail($params);
}
