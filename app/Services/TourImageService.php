<?php

namespace App\Services;

use App\Models\TourImage;

class TourImageService implements TourImageServiceInterface
{
    protected $tourImage;

    public function __construct(TourImage $tourImage)
    {
        $this->tourImage = $tourImage;
    }

    /**
     * get list
     *
     * @return void
     */
    public function getListTourImage($params)
    {
        $query = $this->tourImage->with(['tour'])->select('tour_id')->groupBy('tour_id')->paginate();
        return [
            'data' => $query->map(function ($item) {
                return $item->getTourImageResponse();
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
    public function getAllTourImage($params)
    {
        $query = $this->tourImage->get();
        return $query->map(function ($item) {
            return $item->getTourImageResponse();
        });
    }

    /**
     * create
     *
     * @param array $params
     * @return void
     */
    public function createTourImage($params)
    {
        $tourId = $params['tour_id'];
        $scenics = $params['scenics'];
        $travelers = $params['travelers'];
        $foods = $params['foods'];
        var_dump($scenics);
        foreach ($scenics as $value) {
            $this->tourImage->create([
                'type' => 1,
                'url' => $value,
                'tour_id' => $tourId,
            ]);
        }
        foreach ($travelers as $value) {
            $this->tourImage->create([
                'type' => 2,
                'url' => $value,
                'tour_id' => $tourId,
            ]);
        }
        foreach ($foods as $value) {
            $this->tourImage->create([
                'type' => 3,
                'url' => $value,
                'tour_id' => $tourId,
            ]);
        }
    }

    /**
     * delete
     *
     * @param $id
     * @return void
     */
    public function deleteTourImage($id)
    {
        $this->tourImage->findOrFail($id)->delete();
    }

    /**
     * show
     *
     * @param $id
     * @return void
     */
    public function showTourImage($id)
    {
        return $this->tourImage->findOrFail($id);
    }

    /**
     * edit
     *
     * @param array $params
     * @return void
     */
    public function updateTourImage($params)
    {
        $imagesRemove = $params['imagesRemove'];
        $images = $params['images'];

        foreach ($images as $value) {
            $this->tourImage->findOrFail($value['_id'])->update([
                'type' => $value['type'],
                'url' => $value['url'],
            ]);
        }

        foreach ($imagesRemove as $id) {
            $this->tourImage->findOrFail($id)->delete();
        }
    }

    /**
     * get by tour id
     *
     * @param array $params
     * @return void
     */
    public function getListTourImageByTourId($tourId)
    {
        $query = $this->tourImage->where('tour_id', $tourId)->orderByDesc('created_at')->get();
        return $query->map(function ($item) {
            return $item->getTourImageResponseByTourId();
        });
    }
}