<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Models\Album;
use App\Http\Requests\AlbumRequest;
use App\Services\AlbumServiceInterface;

class AlbumController extends ApiController
{
    protected $albumService;
    protected $response;

    /**
     * construct function
     *
     * @param AlbumServiceInterface $album
     * @param ApiResponse $response
     */
    public function __construct(AlbumServiceInterface $albumService, ApiResponse $response)
    {
        $this->albumService = $albumService;
        $this->response = $response;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = $this->albumService->getListAlbum($request->all());
        return $this->response->withData($list);
    }

    /**
     * Display a all of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $list = $this->albumService->getAllAlbum($request->all());
        return $this->response->withData($list);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlbumRequest $request)
    {
        try {
            $this->albumService->createAlbum($request->all());
            return $this->response->withCreated();
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $album = $this->albumService->showAlbum($id);
        return $this->response->withData($album);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(AlbumRequest $request, $id)
    {
        try {
            $this->albumService->updateAlbum([
                'id' => $id,
                'title' => $request->title,
                'description' => $request->description,
                'content' => $request->content,
                'type' => $request->type,
            ]);
            return $this->response->withMessage('Update successful');
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->albumService->deleteAlbum($id);
            return $this->response->withMessage('Delete successful');
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }
}
