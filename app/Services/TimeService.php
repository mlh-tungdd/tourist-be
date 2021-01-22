<?php

namespace App\Services;

use App\Models\Time;

class TimeService implements TimeServiceInterface
{
    protected $time;

    public function __construct(Time $time)
    {
        $this->time = $time;
    }

    /**
     * get list
     *
     * @return void
     */
    public function getListTime($params)
    {
        $query = $this->time->orderByDesc('created_at')->paginate();
        return [
            'data' => $query->map(function ($item) {
                return $item->getTimeResponse();
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
    public function getAllTime($params)
    {
        $query = $this->time->orderByDesc('created_at')->get();
        return $query->map(function ($item) {
            return $item->getTimeResponse();
        });
    }

    /**
     * create
     *
     * @param array $params
     * @return void
     */
    public function createTime($params)
    {
        $this->time->create([
            'title' => $params['title'],
        ]);
    }

    /**
     * delete
     *
     * @param $id
     * @return void
     */
    public function deleteTime($id)
    {
        $this->time->findOrFail($id)->delete();
    }

    /**
     * show
     *
     * @param $id
     * @return void
     */
    public function showTime($id)
    {
        return $this->time->findOrFail($id);
    }

    /**
     * edit
     *
     * @param array $params
     * @return void
     */
    public function updateTime($params)
    {
        $this->time->findOrFail($params['id'])->update($params);
    }
}