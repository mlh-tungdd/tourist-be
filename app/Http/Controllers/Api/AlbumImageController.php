<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Models\AlbumImage;
use App\Http\Requests\AlbumImageRequest;
use App\Services\AlbumImageServiceInterface;

class AlbumImageController extends ApiController
{
    protected $albumImage;
    protected $response;
    protected $folder = 'album_gallery';

    /**
     * construct function
     *
     * @param AlbumImageServiceInterface $albumImage
     * @param ApiResponse $response
     */
    public function __construct(AlbumImageServiceInterface $albumImage, ApiResponse $response)
    {
        $this->albumImage = $albumImage;
        $this->response = $response;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = $this->albumImage->getListAlbumImage($request->all());
        return $this->response->withData($list);
    }

    /**
     * Display a all of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $list = $this->albumImage->getAllAlbumImage($request->all());
        return $this->response->withData($list);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlbumImageRequest $request)
    {
        try {
            $albums = [];
            if (isset($request->albums)) {
                foreach ($request->albums as $key => $file) {
                    $filenameByRequest = $file->getClientOriginalName();
                    $fileName = pathinfo($filenameByRequest, PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $fileName = $fileName . '_' . $key . time() . '.' . $extension;

                    $file->move(public_path('images/' . $this->folder), $fileName);
                    $albums[] = env('APP_URL') . "/images/" . $this->folder . '/' . $fileName;
                }
            }

            $this->albumImage->createAlbumImage([
                'album_id' => $request->album_id,
                'albums' => $albums,
            ]);
            return $this->response->withCreated();
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Models\AlbumImage  $albumImage
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $albumImage = $this->albumImage->showAlbumImage($id);
        return $this->response->withData($albumImage);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Models\AlbumImage  $albumImage
     * @return \Illuminate\Http\Response
     */
    public function getListByAlbumId($albumId)
    {
        $albumImages = $this->albumImage->getListAlbumImageByAlbumId($albumId);
        return $this->response->withData($albumImages);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Models\AlbumImage  $albumImage
     * @return \Illuminate\Http\Response
     */
    public function update(AlbumImageRequest $request)
    {
        try {
            $this->albumImage->updateAlbumImage($request->all());
            return $this->response->withMessage('Update successful');
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Models\AlbumImage  $albumImage
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->albumImage->deleteAlbumImage($id);
            return $this->response->withMessage('Delete successful');
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }
}
