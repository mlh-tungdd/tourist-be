<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Models\Tour;
use App\Http\Requests\TourRequest;
use App\Services\TourServiceInterface;

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
        $tours = $this->tourService->getListTour($request->all());
        return $this->response->withData($tours);
    }

    /**
     * Display a all of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $tours = $this->tourService->getAllTour($request->all());
        return $this->response->withData($tours);
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
                'vehicle_id' => $request->vehicle_id,
                'departure_id' => $request->departure_id,
                'destination_id' => $request->destination_id,
                'thumbnail' => $fileName,
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
                    'thumbnail' => $fileName,
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
}