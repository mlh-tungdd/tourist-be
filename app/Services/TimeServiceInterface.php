<?php

namespace App\Services;

interface TimeServiceInterface
{
    public function getListTime($params);

    public function getAllTime($params);

    public function createTime($params);

    public function deleteTime($id);

    public function showTime($id);

    public function updateTime($params);
}