<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Models\TourDeparture;
use App\Http\Requests\TourDepartureRequest;
use App\Services\TourDepartureServiceInterface;

class TourDepartureController extends ApiController
{
    protected $tourDeparture;
    protected $response;

    /**
     * construct function
     *
     * @param TourDepartureServiceInterface $tourDeparture
     * @param ApiResponse $response
     */
    public function __construct(TourDepartureServiceInterface $tourDeparture, ApiResponse $response)
    {
        $this->tourDeparture = $tourDeparture;
        $this->response = $response;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = $this->tourDeparture->getListTourDeparture($request->all());
        return $this->response->withData($list);
    }

    /**
     * Display a all of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $list = $this->tourDeparture->getAllTourDeparture($request->all());
        return $this->response->withData($list);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TourDepartureRequest $request)
    {
        try {
            $this->tourDeparture->createTourDeparture($request->all());
            return $this->response->withCreated();
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Models\TourDeparture  $tourDeparture
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tourDeparture = $this->tourDeparture->showTourDeparture($id);
        return $this->response->withData($tourDeparture);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Models\TourDeparture  $tourDeparture
     * @return \Illuminate\Http\Response
     */
    public function getListByTourId($tourId)
    {
        $tourDepartures = $this->tourDeparture->getListTourDepartureByTourId($tourId);
        return $this->response->withData($tourDepartures);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Models\TourDeparture  $tourDeparture
     * @return \Illuminate\Http\Response
     */
    public function update(TourDepartureRequest $request)
    {
        try {
            $this->tourDeparture->updateTourDeparture($request->all());
            return $this->response->withMessage('Update successful');
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Models\TourDeparture  $tourDeparture
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->tourDeparture->deleteTourDeparture($id);
            return $this->response->withMessage('Delete successful');
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeOption(TourDepartureRequest $request)
    {
        try {
            $this->tourDeparture->createTourDepartureOption($request->all());
            return $this->response->withCreated();
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Models\Time  $time
     * @return \Illuminate\Http\Response
     */
    public function updateOption(TourDepartureRequest $request, $id)
    {
        try {
            $this->tourDeparture->updateTourDepartureOption([
                'id' => $id,
                'tour_id' => $request->tour_id,
                'start_day' => $request->start_day,
            ]);
            return $this->response->withMessage('Update successful');
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }
}
