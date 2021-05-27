<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Models\Tour;
use App\Http\Requests\TourRequest;
use App\Services\TourServiceInterface;
use Illuminate\Support\Facades\URL;

class TourController extends ApiController
{
    protected $tourService;
    protected $response;
    protected $folder = 'tours';

    /**
     * construct function
     *
     * @param TourServiceInterface $tour
     * @param ApiResponse $response
     */
    public function __construct(TourServiceInterface $tourService, ApiResponse $response)
    {
        $this->tourService = $tourService;
        $this->response = $response;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = $this->tourService->getListTour($request->all());
        return $this->response->withData($list);
    }

    /**
     * Display a all of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $list = $this->tourService->getAllTour($request->all());
        return $this->response->withData($list);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TourRequest $request)
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

            $this->tourService->createTour([
                'title' => $request->title,
                'description' => $request->description,
                'roll_number' => $request->roll_number,
                'content' => $request->content,
                'schedule' => $request->schedule,
                'term' => $request->term,
                'space' => $request->space,
                'time_id' => $request->time_id,
                'vehicle' => $request->vehicle,
                'departure_id' => $request->departure_id,
                'destination_id' => $request->destination_id,
                'active' => $request->active,
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
     * @param  \App\Models\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tour = $this->tourService->showTour($id);
        return $this->response->withData($tour);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function update(TourRequest $request, $id)
    {
        try {
            if ($request->hasFile('thumbnail')) {
                $filenameByRequest = $request->file('thumbnail')->getClientOriginalName();
                $fileName = pathinfo($filenameByRequest, PATHINFO_FILENAME);
                $extension = $request->file('thumbnail')->getClientOriginalExtension();
                $fileName = $fileName . '_' . time() . '.' . $extension;

                $request->file('thumbnail')->move(public_path('images/' . $this->folder), $fileName);

                $this->tourService->updateTour([
                    'id' => $id,
                    'thumbnail' => env('APP_URL') . "/images/" . $this->folder . '/' . $fileName,
                ]);
            }

            $this->tourService->updateTour([
                'id' => $id,
                'roll_number' => $request->roll_number,
                'title' => $request->title,
                'description' => $request->description,
                'content' => $request->content,
                'schedule' => $request->schedule,
                'term' => $request->term,
                'space' => $request->space,
                'time_id' => $request->time_id,
                'tour_id' => $request->tour_id,
                'departure_id' => $request->departure_id,
                'destination_id' => $request->destination_id,
                'active' => $request->active,
                'vehicle' => $request->vehicle,
            ]);
            return $this->response->withMessage('Update successful');
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->tourService->deleteTour($id);
            return $this->response->withMessage('Delete successful');
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }

    /**
     * Get tour by location id
     */
    public function getListTourByLocationId(Request $request, $id)
    {
        $tours = $this->tourService->getListTourByLocationId([
            'id' => $id,
            'tourId' => $request->tour_id
        ]);
        return $this->response->withData($tours);
    }

    /**
     * Search tour
     */
    public function filterTour(Request $request)
    {
        $list = $this->tourService->filterTour([
            'locale' => $request->locale,
            'departure' => $request->departure,
            'destination' => $request->destination,
            'start' => $request->start,
            'time' => $request->time,
            'price' => $request->price,
        ]);
        return $this->response->withData($list);
    }

    /**
     * Cập nhật status
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            $this->tourService->updateTour([
                'id' => $id,
                'active' => $request->active,
            ]);
            return $this->response->withMessage('Cập nhật trạng thái thành công');
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }

    /**
     * Cập nhật views
     */
    public function updateViews($id)
    {
        try {
            $tour = $this->tourService->showTour($id);
            $this->tourService->updateTour([
                'id' => $id,
                'views' => $tour['views'] + 1,
            ]);
            return $this->response->withMessage('Cập nhật views thành công');
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }
}
