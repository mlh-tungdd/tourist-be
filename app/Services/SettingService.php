<?php

namespace App\Services;

use App\Models\Setting;

class SettingService implements SettingServiceInterface
{
    protected $setting;

    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }

    /**
     * show
     *
     * @param $id
     * @return void
     */
    public function showSetting($id)
    {
        return $this->setting->findOrFail($id)->getSettingResponse();
    }

    /**
     * edit
     *
     * @param array $params
     * @return void
     */
    public function updateSetting($params)
    {
        $this->setting->findOrFail($params['id'])->update($params);
    }
}
