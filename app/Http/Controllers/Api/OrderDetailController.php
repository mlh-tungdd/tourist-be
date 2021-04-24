<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Services\OrderDetailServiceInterface;

class OrderDetailController extends ApiController
{
    protected $orderDetailService;
    protected $response;

    /**
     * construct function
     *
     * @param OrderDetailServiceInterface $orderDetail
     * @param ApiResponse $response
     */
    public function __construct(OrderDetailServiceInterface $orderDetailService, ApiResponse $response)
    {
        $this->orderDetailService = $orderDetailService;
        $this->response = $response;
    }

    /**
     * Display a all of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $list = $this->orderDetailService->getAllOrderDetail($request->all());
        return $this->response->withData($list);
    }
}
