<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Models\Location;
use App\Http\Requests\LocationRequest;
use App\Services\LocationServiceInterface;

class LocationController extends ApiController
{
    protected $locationService;
    protected $response;

    /**
     * construct function
     *
     * @param LocationServiceInterface $location
     * @param ApiResponse $response
     */
    public function __construct(LocationServiceInterface $locationService, ApiResponse $response)
    {
        $this->locationService = $locationService;
        $this->response = $response;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $locations = $this->locationService->getListLocation($request->all());
        return $this->response->withData($locations);
    }

    /**
     * Display a all of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $locations = $this->locationService->getAllLocation($request->all());
        return $this->response->withData($locations);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocationRequest $request)
    {
        try {
            $this->locationService->createLocation($request->all());
            return $this->response->withCreated();
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $location = $this->locationService->showLocation($id);
        return $this->response->withData($location);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(LocationRequest $request, $id)
    {
        try {
            $this->locationService->updateLocation([
                'id' => $id,
                'regions' => $request->regions,
                'city' => $request->city,
                'type' => $request->type,
                'is_departure' => $request->is_departure,
            ]);
            return $this->response->withMessage('Update successful');
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->locationService->deleteLocation($id);
            return $this->response->withMessage('Delete successful');
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }
}
