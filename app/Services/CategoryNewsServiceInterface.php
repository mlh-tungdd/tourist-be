<?php

namespace App\Services;

interface CategoryNewsServiceInterface
{
    public function getListCategoryNews($params);

    public function getAllCategoryNews($params);

    public function createCategoryNews($params);

    public function deleteCategoryNews($id);

    public function showCategoryNews($id);

    public function updateCategoryNews($params);
}
