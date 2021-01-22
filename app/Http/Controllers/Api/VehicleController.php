<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Http\Requests\VehicleRequest;
use App\Services\VehicleServiceInterface;

class VehicleController extends ApiController
{
    protected $vehicleService;
    protected $response;

    /**
     * construct function
     *
     * @param VehicleServiceInterface $vehicle
     * @param ApiResponse $response
     */
    public function __construct(VehicleServiceInterface $vehicleService, ApiResponse $response)
    {
        $this->vehicleService = $vehicleService;
        $this->response = $response;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $vehicles = $this->vehicleService->getListVehicle($request->all());
        return $this->response->withData($vehicles);
    }

    /**
     * Display a all of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $vehicles = $this->vehicleService->getAllVehicle($request->all());
        return $this->response->withData($vehicles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VehicleRequest $request)
    {
        try {
            $this->vehicleService->createVehicle($request->all());
            return $this->response->withCreated();
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vehicle = $this->vehicleService->showVehicle($id);
        return $this->response->withData($vehicle);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(VehicleRequest $request, $id)
    {
        try {
            $this->vehicleService->updateVehicle([
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
     * @param  \App\Models\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->vehicleService->deleteVehicle($id);
            return $this->response->withMessage('Delete successful');
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }
}