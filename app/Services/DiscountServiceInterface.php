<?php

namespace App\Services;

interface DiscountServiceInterface
{
    public function getListDiscount($params);

    public function getAllDiscount($params);

    public function createDiscount($params);

    public function deleteDiscount($id);

    public function showDiscount($id);

    public function updateDiscount($params);
}
