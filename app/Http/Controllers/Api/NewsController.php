<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Models\News;
use App\Http\Requests\NewsRequest;
use App\Services\NewsServiceInterface;

class NewsController extends ApiController
{
    protected $newsService;
    protected $response;
    protected $folder = 'news';

    /**
     * construct function
     *
     * @param NewsServiceInterface $news
     * @param ApiResponse $response
     */
    public function __construct(NewsServiceInterface $newsService, ApiResponse $response)
    {
        $this->newsService = $newsService;
        $this->response = $response;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = $this->newsService->getListNews($request->all());
        return $this->response->withData($list);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {
        try {
            $fileName = null;
            if ($request->hasFile('thumbnail')) {
                $filenameByRequest = $request->file('thumbnail')->getClientOriginalName();
                $fileName = pathinfo($filenameByRequest, PATHINFO_FILENAME);
                $extension = $request->file('thumbnail')->getClientOriginalExtension();
                $fileName = $fileName . '_' . time() . '.' . $extension;

                $request->file('thumbnail')->move(public_path('images/' . $this->folder), $fileName);
            }

            $this->newsService->createNews([
                'title' => $request->title,
                'description' => $request->description,
                'content' => $request->content,
                'author' => $request->author,
                'category_news_id' => $request->category_news_id,
                'thumbnail' => env('APP_URL') . "/images/" . $this->folder . '/' . $fileName,
            ]);
            return $this->response->withCreated();
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = $this->newsService->showNews($id);
        return $this->response->withData($news);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(NewsRequest $request, $id)
    {
        try {
            if ($request->hasFile('thumbnail')) {
                $filenameByRequest = $request->file('thumbnail')->getClientOriginalName();
                $fileName = pathinfo($filenameByRequest, PATHINFO_FILENAME);
                $extension = $request->file('thumbnail')->getClientOriginalExtension();
                $fileName = env('APP_URL') . $fileName . '_' . time() . '.' . $extension;

                $request->file('thumbnail')->move(public_path('images/' . $this->folder), $fileName);

                $this->newsService->updateNews([
                    'id' => $id,
                    'thumbnail' => env('APP_URL') . "/images/" . $this->folder . '/' . $fileName,
                ]);
            }

            $this->newsService->updateNews([
                'id' => $id,
                'title' => $request->title,
                'description' => $request->description,
                'content' => $request->content,
                'author' => $request->author,
                'category_news_id' => $request->category_news_id,
            ]);
            return $this->response->withMessage('Update successful');
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->newsService->deleteNews($id);
            return $this->response->withMessage('Delete successful');
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }
}
