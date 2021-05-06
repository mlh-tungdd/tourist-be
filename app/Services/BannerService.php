<?php

namespace App\Services;

use App\Models\Banner;

class BannerService implements BannerServiceInterface
{
    protected $banner;

    public function __construct(Banner $banner)
    {
        $this->banner = $banner;
    }

    /**
     * get list
     *
     * @return void
     */
    public function getListBanner($params)
    {
        $query = $this->banner->orderByDesc('created_at');
        $title = $params['title'] ?? null;

        if ($title != null) {
            $query->where('title', 'like', '%' . $title . '%');
        }

        $active = $params['active'] ?? null;
        if ($active != null) {
            $query->where('active', $active);
        }

        $query = $query->paginate();

        return [
            'data' => $query->map(function ($item) {
                return $item->getBannerResponse();
            }),
            'per_page' => $query->perPage(),
            'total' => $query->total(),
            'current_page' => $query->currentPage(),
            'last_page' => $query->lastPage(),
        ];
    }

    /**
     * get all
     *
     * @return void
     */
    public function getAllBanner($params)
    {
        $query = $this->banner->orderByDesc('created_at');
        return $query->get()->map(function ($item) {
            return $item->getBannerResponse();
        });
    }

    /**
     * create
     *
     * @param array $params
     * @return void
     */
    public function createBanner($params)
    {
        $this->banner->create([
            'title' => $params['title'],
            'url' => $params['url'],
            'thumbnail' => $params['thumbnail'],
            'active' => $params['active']
        ]);
    }

    /**
     * delete
     *
     * @param $id
     * @return void
     */
    public function deleteBanner($id)
    {
        $this->banner->findOrFail($id)->delete();
    }

    /**
     * show
     *
     * @param $id
     * @return void
     */
    public function showBanner($id)
    {
        return $this->banner->findOrFail($id)->getBannerResponse();
    }

    /**
     * edit
     *
     * @param array $params
     * @return void
     */
    public function updateBanner($params)
    {
        $this->banner->findOrFail($params['id'])->update($params);
    }
}
