<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Models\TourImage;
use App\Http\Requests\TourImageRequest;
use App\Services\TourImageServiceInterface;

class TourImageController extends ApiController
{
    protected $tourImage;
    protected $response;
    protected $folder = 'tour_gallery';

    /**
     * construct function
     *
     * @param TourImageServiceInterface $tourImage
     * @param ApiResponse $response
     */
    public function __construct(TourImageServiceInterface $tourImage, ApiResponse $response)
    {
        $this->tourImage = $tourImage;
        $this->response = $response;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tourImages = $this->tourImage->getListTourImage($request->all());
        return $this->response->withData($tourImages);
    }

    /**
     * Display a all of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $tourImages = $this->tourImage->getAllTourImage($request->all());
        return $this->response->withData($tourImages);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TourImageRequest $request)
    {
        try {
            $scenics = [];
            $travelers = [];
            $foods = [];
            if (isset($request->scenics)) {
                foreach ($request->scenics as $key => $file) {
                    $filenameByRequest = $file->getClientOriginalName();
                    $fileName = pathinfo($filenameByRequest, PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $fileName = $fileName . '_' . $key . time() . '.' . $extension;

                    $file->move(public_path('images/' . $this->folder), $fileName);
                    $scenics[] = $fileName;
                }
            }
            if (isset($request->travelers)) {
                foreach ($request->travelers as $key => $file) {
                    $filenameByRequest = $file->getClientOriginalName();
                    $fileName = pathinfo($filenameByRequest, PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $fileName = $fileName . '_' . $key . time() . '.' . $extension;

                    $file->move(public_path('images/' . $this->folder), $fileName);
                    $travelers[] = $fileName;
                }
            }

            if (isset($request->travelers)) {
                foreach ($request->foods as $key => $file) {
                    $filenameByRequest = $file->getClientOriginalName();
                    $fileName = pathinfo($filenameByRequest, PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $fileName = $fileName . '_' . $key . time() . '.' . $extension;

                    $file->move(public_path('images/' . $this->folder), $fileName);
                    $foods[] = $fileName;
                }
            }

            $this->tourImage->createTourImage([
                'tour_id' => $request->tour_id,
                'scenics' => $scenics,
                'travelers' => $travelers,
                'foods' => $foods,
            ]);
            return $this->response->withCreated();
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Models\TourImage  $tourImage
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tourImage = $this->tourImage->showTourImage($id);
        return $this->response->withData($tourImage);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Models\TourImage  $tourImage
     * @return \Illuminate\Http\Response
     */
    public function getListByTourId($tourId)
    {
        $tourImages = $this->tourImage->getListTourImageByTourId($tourId);
        return $this->response->withData($tourImages);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Models\TourImage  $tourImage
     * @return \Illuminate\Http\Response
     */
    public function update(TourImageRequest $request)
    {
        try {
            $this->tourImage->updateTourImage($request->all());
            return $this->response->withMessage('Update successful');
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Models\TourImage  $tourImage
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->tourImage->deleteTourImage($id);
            return $this->response->withMessage('Delete successful');
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }
}