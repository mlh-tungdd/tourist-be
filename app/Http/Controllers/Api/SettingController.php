<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Services\SettingServiceInterface;

class SettingController extends ApiController
{
    protected $settingService;
    protected $response;
    protected $folder = 'settings';

    /**
     * construct function
     *
     * @param SettingServiceInterface $setting
     * @param ApiResponse $response
     */
    public function __construct(SettingServiceInterface $settingService, ApiResponse $response)
    {
        $this->settingService = $settingService;
        $this->response = $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $setting = $this->settingService->showSetting(1);
        return $this->response->withData($setting);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            if ($request->hasFile('logo')) {
                $filenameByRequest = $request->file('logo')->getClientOriginalName();
                $fileName = pathinfo($filenameByRequest, PATHINFO_FILENAME);
                $extension = $request->file('logo')->getClientOriginalExtension();
                $fileName = $fileName . '_' . time() . '.' . $extension;

                $request->file('logo')->move(public_path('images/' . $this->folder), $fileName);

                $this->settingService->updateSetting([
                    'id' => 1,
                    'logo' => env('APP_URL') . "/images/" . $this->folder . '/' . $fileName,
                ]);
            }

            $this->settingService->updateSetting([
                'id' => 1,
                'title' => $request->title,
                'company' => $request->company,
                'content' => $request->content,
                'favicon' => $request->favicon,
                'website' => $request->website,
                'address' => $request->address,
                'hotline' => $request->hotline,
                'email' => $request->email,
                'facebook' => $request->facebook,
                'youtube' => $request->youtube,
                'google' => $request->google,
                'instagram' => $request->instagram,
            ]);
            return $this->response->withMessage('Cập nhật thành công!');
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }
}
