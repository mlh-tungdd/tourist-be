<?php

namespace App\Services;

interface BankServiceInterface
{
    public function getListBank($params);

    public function getAllBank($params);

    public function createBank($params);

    public function deleteBank($id);

    public function showBank($id);

    public function updateBank($params);
}
