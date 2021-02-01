<?php

namespace App\Services;

interface PartnerServiceInterface
{
    public function getListPartner($params);

    public function getAllPartner($params);

    public function createPartner($params);

    public function deletePartner($id);

    public function showPartner($id);

    public function updatePartner($params);
}
