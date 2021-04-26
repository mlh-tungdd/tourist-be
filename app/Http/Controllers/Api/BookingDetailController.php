<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Services\BookingDetailServiceInterface;

class BookingDetailController extends ApiController
{
    protected $bookingDetailService;
    protected $response;

    /**
     * construct function
     *
     * @param BookingDetailServiceInterface $bookingDetail
     * @param ApiResponse $response
     */
    public function __construct(BookingDetailServiceInterface $bookingDetailService, ApiResponse $response)
    {
        $this->bookingDetailService = $bookingDetailService;
        $this->response = $response;
    }

    /**
     * Display a all of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $list = $this->bookingDetailService->getAllBookingDetail($request->all());
        return $this->response->withData($list);
    }
}
