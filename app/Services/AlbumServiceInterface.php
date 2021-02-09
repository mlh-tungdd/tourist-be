<?php

namespace App\Services;

interface AlbumServiceInterface
{
    public function getListAlbum($params);

    public function getAllAlbum($params);

    public function createAlbum($params);

    public function deleteAlbum($id);

    public function showAlbum($id);

    public function updateAlbum($params);
}
