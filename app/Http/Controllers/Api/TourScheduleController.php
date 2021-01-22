<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Models\TourSchedule;
use App\Http\Requests\TourScheduleRequest;
use App\Services\TourScheduleServiceInterface;

class TourScheduleController extends ApiController
{
    protected $tourSchedule;
    protected $response;

    /**
     * construct function
     *
     * @param TourScheduleServiceInterface $tourSchedule
     * @param ApiResponse $response
     */
    public function __construct(TourScheduleServiceInterface $tourSchedule, ApiResponse $response)
    {
        $this->tourSchedule = $tourSchedule;
        $this->response = $response;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tourSchedules = $this->tourSchedule->getListTourSchedule($request->all());
        return $this->response->withData($tourSchedules);
    }

    /**
     * Display a all of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $tourSchedules = $this->tourSchedule->getAllTourSchedule($request->all());
        return $this->response->withData($tourSchedules);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TourScheduleRequest $request)
    {
        try {
            $this->tourSchedule->createTourSchedule($request->all());
            return $this->response->withCreated();
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Models\TourSchedule  $tourSchedule
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tourSchedule = $this->tourSchedule->showTourSchedule($id);
        return $this->response->withData($tourSchedule);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Models\TourSchedule  $tourSchedule
     * @return \Illuminate\Http\Response
     */
    public function getListByTourId($tourId)
    {
        $tourSchedules = $this->tourSchedule->getListTourScheduleByTourId($tourId);
        return $this->response->withData($tourSchedules);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Models\TourSchedule  $tourSchedule
     * @return \Illuminate\Http\Response
     */
    public function update(TourScheduleRequest $request)
    {
        try {
            $this->tourSchedule->updateTourSchedule($request->all());
            return $this->response->withMessage('Update successful');
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Models\TourSchedule  $tourSchedule
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->tourSchedule->deleteTourSchedule($id);
            return $this->response->withMessage('Delete successful');
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }
}