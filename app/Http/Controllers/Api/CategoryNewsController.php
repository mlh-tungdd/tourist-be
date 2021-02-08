<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Models\CategoryNews;
use App\Http\Requests\CategoryNewsRequest;
use App\Services\CategoryNewsServiceInterface;

class CategoryNewsController extends ApiController
{
    protected $categoryNewsService;
    protected $response;

    /**
     * construct function
     *
     * @param CategoryNewsServiceInterface $categoryNews
     * @param ApiResponse $response
     */
    public function __construct(CategoryNewsServiceInterface $categoryNewsService, ApiResponse $response)
    {
        $this->categoryNewsService = $categoryNewsService;
        $this->response = $response;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = $this->categoryNewsService->getListCategoryNews($request->all());
        return $this->response->withData($list);
    }

    /**
     * Display a all of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $list = $this->categoryNewsService->getAllCategoryNews($request->all());
        return $this->response->withData($list);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryNewsRequest $request)
    {
        try {
            $this->categoryNewsService->createCategoryNews([
                'title' => $request->title,
                'parent_id' => $request->parent_id,
            ]);
            return $this->response->withCreated();
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Models\CategoryNews  $categoryNews
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categoryNews = $this->categoryNewsService->showCategoryNews($id);
        return $this->response->withData($categoryNews);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Models\CategoryNews  $categoryNews
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryNewsRequest $request, $id)
    {
        try {
            $this->categoryNewsService->updateCategoryNews([
                'id' => $id,
                'title' => $request->title,
                'parent_id' => $request->parent_id,
            ]);
            return $this->response->withMessage('Update successful');
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Models\CategoryNews  $categoryNews
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->categoryNewsService->deleteCategoryNews($id);
            return $this->response->withMessage('Delete successful');
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }
}
