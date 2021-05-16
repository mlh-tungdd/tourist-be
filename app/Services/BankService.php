<?php

namespace App\Services;

use App\Models\Bank;

class BankService implements BankServiceInterface
{
    protected $bank;

    public function __construct(Bank $bank)
    {
        $this->bank = $bank;
    }

    /**
     * get list
     *
     * @return void
     */
    public function getListBank($params)
    {
        $query = $this->bank->orderByDesc('created_at')->paginate();
        return [
            'data' => $query->map(function ($item) {
                return $item->getBankResponse();
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
    public function getAllBank($params)
    {
        $query = $this->bank->orderByDesc('created_at')->get();
        return $query->map(function ($item) {
            return $item->getBankResponse();
        });
    }

    /**
     * create
     *
     * @param array $params
     * @return void
     */
    public function createBank($params)
    {
        $this->bank->create([
            'name' => $params['name'],
            'thumbnail' => $params['thumbnail'],
            'address' => $params['address'],
            'number_account' => $params['number_account'],
            'name_account' => $params['name_account'],
        ]);
    }

    /**
     * delete
     *
     * @param $id
     * @return void
     */
    public function deleteBank($id)
    {
        $this->bank->findOrFail($id)->delete();
    }

    /**
     * show
     *
     * @param $id
     * @return void
     */
    public function showBank($id)
    {
        return $this->bank->findOrFail($id)->getBankResponse();
    }

    /**
     * edit
     *
     * @param array $params
     * @return void
     */
    public function updateBank($params)
    {
        $this->bank->findOrFail($params['id'])->update($params);
    }
}
