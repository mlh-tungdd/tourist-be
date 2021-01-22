<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Models\Time;
use App\Http\Requests\TimeRequest;
use App\Services\TimeServiceInterface;

class TimeController extends ApiController
{
    protected $timeService;
    protected $response;

    /**
     * construct function
     *
     * @param TimeServiceInterface $time
     * @param ApiResponse $response
     */
    public function __construct(TimeServiceInterface $timeService, ApiResponse $response)
    {
        $this->timeService = $timeService;
        $this->response = $response;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $times = $this->timeService->getListTime($request->all());
        return $this->response->withData($times);
    }

    /**
     * Display a all of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $times = $this->timeService->getAllTime($request->all());
        return $this->response->withData($times);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TimeRequest $request)
    {
        try {
            $this->timeService->createTime($request->all());
            return $this->response->withCreated();
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Models\Time  $time
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $time = $this->timeService->showTime($id);
        return $this->response->withData($time);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Models\Time  $time
     * @return \Illuminate\Http\Response
     */
    public function update(TimeRequest $request, $id)
    {
        try {
            $this->timeService->updateTime([
                'id' => $id,
                'title' => $request->title
            ]);
            return $this->response->withMessage('Update successful');
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Models\Time  $time
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->timeService->deleteTime($id);
            return $this->response->withMessage('Delete successful');
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }
}