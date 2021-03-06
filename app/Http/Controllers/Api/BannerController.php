<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Http\Requests\BannerRequest;
use App\Services\BannerServiceInterface;

class BannerController extends ApiController
{
    protected $bannerService;
    protected $response;
    protected $folder = 'banners';

    /**
     * construct function
     *
     * @param BannerServiceInterface $banner
     * @param ApiResponse $response
     */
    public function __construct(BannerServiceInterface $bannerService, ApiResponse $response)
    {
        $this->bannerService = $bannerService;
        $this->response = $response;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = $this->bannerService->getListBanner($request->all());
        return $this->response->withData($list);
    }

    /**
     * Display a all of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $list = $this->bannerService->getAllBanner($request->all());
        return $this->response->withData($list);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BannerRequest $request)
    {
        try {
            $fileName = null;
            if ($request->hasFile('thumbnail')) {
                $filenameByRequest = $request->file('thumbnail')->getClientOriginalName();
                $fileName = pathinfo($filenameByRequest, PATHINFO_FILENAME);
                $extension = $request->file('thumbnail')->getClientOriginalExtension();
                $fileName = $fileName . '_' . time() . '.' . $extension;

                $request->file('thumbnail')->move(public_path('images/' . $this->folder), $fileName);
            }

            $this->bannerService->createBanner([
                'title' => $request->title,
                'url' => $request->url,
                'active' => $request->active,
                'thumbnail' => env('APP_URL') . "/images/" . $this->folder . '/' . $fileName,
            ]);
            return $this->response->withCreated();
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $banner = $this->bannerService->showBanner($id);
        return $this->response->withData($banner);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(BannerRequest $request, $id)
    {
        try {
            if ($request->hasFile('thumbnail')) {
                $filenameByRequest = $request->file('thumbnail')->getClientOriginalName();
                $fileName = pathinfo($filenameByRequest, PATHINFO_FILENAME);
                $extension = $request->file('thumbnail')->getClientOriginalExtension();
                $fileName = $fileName . '_' . time() . '.' . $extension;

                $request->file('thumbnail')->move(public_path('images/' . $this->folder), $fileName);

                $this->bannerService->updateBanner([
                    'id' => $id,
                    'thumbnail' => env('APP_URL') . "/images/" . $this->folder . '/' . $fileName,
                ]);
            }

            $this->bannerService->updateBanner([
                'id' => $id,
                'title' => $request->title,
                'url' => $request->url,
                'active' => $request->active,
            ]);
            return $this->response->withMessage('Cập nhật thành công');
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->bannerService->deleteBanner($id);
            return $this->response->withMessage('Xoá thành công');
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }

    /**
     * Cập nhật status
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            $this->bannerService->updateBanner([
                'id' => $id,
                'active' => $request->active,
            ]);
            return $this->response->withMessage('Cập nhật trạng thái thành công');
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }
}
