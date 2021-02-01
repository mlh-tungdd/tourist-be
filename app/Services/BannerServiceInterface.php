<?php

namespace App\Services;

interface BannerServiceInterface
{
    public function getListBanner($params);

    public function getAllBanner($params);

    public function createBanner($params);

    public function deleteBanner($id);

    public function showBanner($id);

    public function updateBanner($params);
}
