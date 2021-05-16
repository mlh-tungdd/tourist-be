<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Models\Rate;
use App\Http\Requests\RateRequest;
use App\Services\RateServiceInterface;

class RateController extends ApiController
{
    protected $rateService;
    protected $response;

    /**
     * construct function
     *
     * @param RateServiceInterface $rate
     * @param ApiResponse $response
     */
    public function __construct(RateServiceInterface $rateService, ApiResponse $response)
    {
        $this->rateService = $rateService;
        $this->response = $response;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tourId)
    {
        $list = $this->rateService->getListRate($tourId);
        return $this->response->withData($list);
    }

    /**
     * Display a all of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $list = $this->rateService->getAllRate($request->all());
        return $this->response->withData($list);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RateRequest $request)
    {
        try {
            $this->rateService->createRate($request->all());
            return $this->response->withCreated();
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Models\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rate = $this->rateService->showRate($id);
        return $this->response->withData($rate);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Models\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function update(RateRequest $request, $id)
    {
        try {
            $this->rateService->updateRate([
                'id' => $id,
                'rate' => $request->rate,
                'content' => $request->content,
                'user_id' => $request->user_id,
                'tour_id' => $request->tour_id,
            ]);
            return $this->response->withMessage('Update successful');
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Models\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->rateService->deleteRate($id);
            return $this->response->withMessage('Delete successful');
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }
}
