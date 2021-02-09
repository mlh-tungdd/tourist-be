<?php

namespace App\Services;

use App\Models\Album;

class AlbumService implements AlbumServiceInterface
{
    protected $album;

    public function __construct(Album $album)
    {
        $this->album = $album;
    }

    /**
     * get list
     *
     * @return void
     */
    public function getListAlbum($params)
    {
        $query = $this->album->orderByDesc('created_at')->paginate();
        return [
            'data' => $query->map(function ($item) {
                return $item->getAlbumResponse();
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
    public function getAllAlbum($params)
    {
        $query = $this->album->orderByDesc('created_at')->get();
        return $query->map(function ($item) {
            return $item->getAlbumResponse();
        });
    }

    /**
     * create
     *
     * @param array $params
     * @return void
     */
    public function createAlbum($params)
    {
        $this->album->create([
            'title' => $params['title'],
            'description' => $params['description'],
            'content' => $params['content'],
            'type' => $params['type'],
        ]);
    }

    /**
     * delete
     *
     * @param $id
     * @return void
     */
    public function deleteAlbum($id)
    {
        $this->album->findOrFail($id)->delete();
    }

    /**
     * show
     *
     * @param $id
     * @return void
     */
    public function showAlbum($id)
    {
        return $this->album->findOrFail($id);
    }

    /**
     * edit
     *
     * @param array $params
     * @return void
     */
    public function updateAlbum($params)
    {
        $this->album->findOrFail($params['id'])->update($params);
    }
}
