<?php

namespace App\Services;

interface SettingServiceInterface
{
    public function showSetting($id);

    public function updateSetting($params);
}
