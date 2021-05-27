<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\BookingRequest;
use App\Services\BookingServiceInterface;
use App\Services\UserServiceInterface;
use App\Services\BookingDetailServiceInterface;
use Illuminate\Support\Facades\DB;
use Mail;

class BookingController extends ApiController
{
    protected $bookingService;
    protected $bookingDetailService;
    protected $userService;
    protected $response;

    /**
     * construct function
     *
     * @param BookingServiceInterface $booking
     * @param UserServiceInterface $user
     * @param ApiResponse $response
     */
    public function __construct(BookingServiceInterface $bookingService, UserServiceInterface $userService, BookingDetailServiceInterface $bookingDetailService, ApiResponse $response)
    {
        $this->bookingService = $bookingService;
        $this->bookingDetailService = $bookingDetailService;
        $this->userService = $userService;
        $this->response = $response;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = $this->bookingService->getListBooking($request->all());
        return $this->response->withData($list);
    }

    /**
     * Display a all of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $list = $this->bookingService->getAllBooking($request->all());
        return $this->response->withData($list);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookingRequest $request)
    {
        try {
            $booking = null;
            $emails = null;
            if (!$request->is_create_user) {
                $booking = $this->bookingService->createBooking([
                    'total' => $request->total,
                    'status' => 0,
                    'user_id' => $request->user['id'],
                ]);
                $emails = $request->user['email'];
            } else {
                $user = $this->userService->register($request->user);
                $emails = $user->email;
                $booking = $this->bookingService->createBooking([
                    'total' => $request->total,
                    'status' => 0,
                    'user_id' => $user->id,
                ]);
            }

            foreach ($request->bookings as $item) {
                $this->bookingDetailService->createBookingDetail([
                    'start_day' => $item['start_day'],
                    'end_day' => $item['end_day'],
                    'qty' => $item['qty'],
                    'price' => $item['price'],
                    'booking_id' => $booking->id,
                    'room_id' => $item['room_id'],
                    'hotel_id' => $item['hotel_id'],
                ]);
                $room = DB::table("rooms")->where('id', $item['room_id'])->where('hotel_id', $item['hotel_id'])->first();
                DB::table("rooms")->where('id', $item['room_id'])->where('hotel_id', $item['hotel_id'])->update([
                    'qty' => $room->space - $item['qty']
                ]);
            }

            Mail::to($emails)->send(new \App\Mail\BookingMail(['emails' => $emails]));

            return $this->response->withCreated();
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $booking = $this->bookingService->showBooking($id);
        return $this->response->withData($booking);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(BookingRequest $request, $id)
    {
        try {
            $this->bookingService->updateBooking([
                'id' => $id,
                'status' => $request->status,
            ]);
            return $this->response->withMessage('Cập nhật thành công');
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->bookingService->deleteBooking($id);
            return $this->response->withMessage('Xoá thành công');
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }
}
