<?php

namespace App\Services;

interface NewsServiceInterface
{
    public function getListNews($params);

    public function createNews($params);

    public function deleteNews($id);

    public function showNews($id);

    public function updateNews($params);
}
