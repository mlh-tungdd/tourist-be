<?php

namespace App\Services;

use App\Models\CategoryNews;

class CategoryNewsService implements CategoryNewsServiceInterface
{
    protected $categoryNews;

    public function __construct(CategoryNews $categoryNews)
    {
        $this->categoryNews = $categoryNews;
    }

    /**
     * get list
     *
     * @return void
     */
    public function getListCategoryNews($params)
    {
        $query = $this->categoryNews->orderByDesc('created_at')->paginate();
        return [
            'data' => $query->map(function ($item) {
                return $item->getCategoryNewsResponse();
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
    public function getAllCategoryNews($params)
    {
        $query = $this->categoryNews->orderByDesc('created_at');
        return $query->get()->map(function ($item) {
            return $item->getCategoryNewsResponse();
        });
    }

    /**
     * create
     *
     * @param array $params
     * @return void
     */
    public function createCategoryNews($params)
    {
        $this->categoryNews->create([
            'title' => $params['title'],
            'parent_id' => $params['parent_id'],
        ]);
    }

    /**
     * delete
     *
     * @param $id
     * @return void
     */
    public function deleteCategoryNews($id)
    {
        $this->categoryNews->findOrFail($id)->delete();
    }

    /**
     * show
     *
     * @param $id
     * @return void
     */
    public function showCategoryNews($id)
    {
        return $this->categoryNews->findOrFail($id);
    }

    /**
     * edit
     *
     * @param array $params
     * @return void
     */
    public function updateCategoryNews($params)
    {
        $this->categoryNews->findOrFail($params['id'])->update($params);
    }
}
