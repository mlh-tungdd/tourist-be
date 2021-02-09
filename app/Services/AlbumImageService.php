<?php

namespace App\Services;

use App\Models\AlbumImage;

class AlbumImageService implements AlbumImageServiceInterface
{
    protected $albumImage;

    public function __construct(AlbumImage $albumImage)
    {
        $this->albumImage = $albumImage;
    }

    /**
     * get list
     *
     * @return void
     */
    public function getListAlbumImage($params)
    {
        $query = $this->albumImage->with(['album'])->select('album_id')->groupBy('album_id')->paginate();
        return [
            'data' => $query->map(function ($item) {
                return $item->getAlbumImageResponse();
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
    public function getAllAlbumImage($params)
    {
        $query = $this->albumImage->get();
        return $query->map(function ($item) {
            return $item->getAlbumImageResponse();
        });
    }

    /**
     * create
     *
     * @param array $params
     * @return void
     */
    public function createAlbumImage($params)
    {
        $albumId = $params['album_id'];
        $albums = $params['albums'];
        foreach ($albums as $value) {
            $this->albumImage->create([
                'thumbnail' => $value,
                'album_id' => $albumId,
            ]);
        }
    }

    /**
     * delete
     *
     * @param $id
     * @return void
     */
    public function deleteAlbumImage($id)
    {
        $this->albumImage->findOrFail($id)->delete();
    }

    /**
     * show
     *
     * @param $id
     * @return void
     */
    public function showAlbumImage($id)
    {
        return $this->albumImage->findOrFail($id);
    }

    /**
     * edit
     *
     * @param array $params
     * @return void
     */
    public function updateAlbumImage($params)
    {
        $imagesRemove = $params['imagesRemove'];
        $images = $params['images'];

        foreach ($images as $value) {
            $this->albumImage->findOrFail($value['_id'])->update([
                'thumbnail' => $value['thumbnail'],
            ]);
        }

        foreach ($imagesRemove as $id) {
            $this->albumImage->findOrFail($id)->delete();
        }
    }

    /**
     * get by album id
     *
     * @param array $params
     * @return void
     */
    public function getListAlbumImageByAlbumId($albumId)
    {
        $query = $this->albumImage->where('album_id', $albumId)->orderByDesc('created_at')->get();
        return $query->map(function ($item) {
            return $item->getAlbumImageResponseByAlbumId();
        });
    }
}
