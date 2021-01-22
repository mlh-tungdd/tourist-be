<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Models\TourPrice;
use App\Http\Requests\TourPriceRequest;
use App\Services\TourPriceServiceInterface;

class TourPriceController extends ApiController
{
    protected $tourPrice;
    protected $response;

    /**
     * construct function
     *
     * @param TourPriceServiceInterface $tourPrice
     * @param ApiResponse $response
     */
    public function __construct(TourPriceServiceInterface $tourPrice, ApiResponse $response)
    {
        $this->tourPrice = $tourPrice;
        $this->response = $response;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tourPrices = $this->tourPrice->getListTourPrice($request->all());
        return $this->response->withData($tourPrices);
    }

    /**
     * Display a all of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $tourPrices = $this->tourPrice->getAllTourPrice($request->all());
        return $this->response->withData($tourPrices);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TourPriceRequest $request)
    {
        try {
            $this->tourPrice->createTourPrice($request->all());
            return $this->response->withCreated();
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Models\TourPrice  $tourPrice
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tourPrice = $this->tourPrice->showTourPrice($id);
        return $this->response->withData($tourPrice);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Models\TourPrice  $tourPrice
     * @return \Illuminate\Http\Response
     */
    public function getListByTourId($tourId)
    {
        $tourPrices = $this->tourPrice->getListTourPriceByTourId($tourId);
        return $this->response->withData($tourPrices);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Models\TourPrice  $tourPrice
     * @return \Illuminate\Http\Response
     */
    public function update(TourPriceRequest $request)
    {
        try {
            $this->tourPrice->updateTourPrice($request->all());
            return $this->response->withMessage('Update successful');
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Models\TourPrice  $tourPrice
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->tourPrice->deleteTourPrice($id);
            return $this->response->withMessage('Delete successful');
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }
}