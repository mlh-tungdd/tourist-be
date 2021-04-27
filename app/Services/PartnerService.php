<?php

namespace App\Services;

use App\Models\Partner;

class PartnerService implements PartnerServiceInterface
{
    protected $partner;

    public function __construct(Partner $partner)
    {
        $this->partner = $partner;
    }

    /**
     * get list
     *
     * @return void
     */
    public function getListPartner($params)
    {
        $query = $this->partner->orderByDesc('created_at');
        $title = $params['title'] ?? null;

        if ($title != null) {
            $query->where('title', 'like', '%' . $title . '%');
        }

        $query = $query->paginate();

        return [
            'data' => $query->map(function ($item) {
                return $item->getPartnerResponse();
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
    public function getAllPartner($params)
    {
        $query = $this->partner->orderByDesc('created_at');
        return $query->get()->map(function ($item) {
            return $item->getPartnerResponse();
        });
    }

    /**
     * create
     *
     * @param array $params
     * @return void
     */
    public function createPartner($params)
    {
        $this->partner->create([
            'title' => $params['title'],
            'url' => $params['url'],
            'thumbnail' => $params['thumbnail'],
        ]);
    }

    /**
     * delete
     *
     * @param $id
     * @return void
     */
    public function deletePartner($id)
    {
        $this->partner->findOrFail($id)->delete();
    }

    /**
     * show
     *
     * @param $id
     * @return void
     */
    public function showPartner($id)
    {
        return $this->partner->findOrFail($id);
    }

    /**
     * edit
     *
     * @param array $params
     * @return void
     */
    public function updatePartner($params)
    {
        $this->partner->findOrFail($params['id'])->update($params);
    }
}
