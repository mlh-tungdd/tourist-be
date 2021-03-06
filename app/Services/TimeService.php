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
        $query = $this->time->orderByDesc('created_at');
        $title = $params['title'] ?? null;

        if ($title != null) {
            $query->where('title', 'like', '%' . $title . '%');
        }

        $query = $query->paginate();

        return [
            'data' => [
                'fanclub_member_ng_users' => [
                    'list' => $query->map(function ($item) {
                        return $item->getTimeResponse();
                    }),
                    'total' => $query->total()
                ]
            ],
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
