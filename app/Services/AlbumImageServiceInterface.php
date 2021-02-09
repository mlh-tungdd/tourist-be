<?php

namespace App\Services;

interface AlbumImageServiceInterface
{
    public function getListAlbumImage($params);

    public function getAllAlbumImage($params);

    public function createAlbumImage($params);

    public function deleteAlbumImage($id);

    public function showAlbumImage($id);

    public function updateAlbumImage($params);

    public function getListAlbumImageByAlbumId($tourId);
}
