<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Services\OrderServiceInterface;
use App\Services\UserServiceInterface;
use App\Services\OrderDetailServiceInterface;

class OrderController extends ApiController
{
    protected $orderService;
    protected $orderDetailService;
    protected $userService;
    protected $response;

    /**
     * construct function
     *
     * @param OrderServiceInterface $order
     * @param UserServiceInterface $user
     * @param ApiResponse $response
     */
    public function __construct(OrderServiceInterface $orderService, UserServiceInterface $userService, OrderDetailServiceInterface $orderDetailService, ApiResponse $response)
    {
        $this->orderService = $orderService;
        $this->orderDetailService = $orderDetailService;
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
        $list = $this->orderService->getListOrder($request->all());
        return $this->response->withData($list);
    }

    /**
     * Display a all of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $list = $this->orderService->getAllOrder($request->all());
        return $this->response->withData($list);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        try {
            $order = null;
            if (!$request->is_create_user) {
                $order = $this->orderService->createOrder([
                    'total' => $request->total,
                    'status' => 0,
                    'payment_method' => $request->payment['method'],
                    'payment_type' => $request->payment['type'],
                    'user_id' => $request->user['id'],
                ]);
            } else {
                $user = $this->userService->register($request->user);
                $order = $this->orderService->createOrder([
                    'total' => $request->total,
                    'status' => 0,
                    'payment_method' => $request->payment['method'],
                    'payment_type' => $request->payment['type'],
                    'user_id' => $user->id,
                ]);
            }

            foreach ($request->carts as $cart) {
                foreach ($cart['departures'] as $departure) {
                    foreach ($departure['prices'] as $price) {
                        $this->orderDetailService->createOrderDetail([
                            'tour_id' => $cart['id'],
                            'order_id' => $order->id,
                            'departure_id' => $departure['id'],
                            'price_id' => $price['id'],
                            'qty' => $price['qty'],
                            'price' => $price['price'],
                            'type_customer' => $price['type_customer'],
                        ]);
                    }
                }
            }

            return $this->response->withCreated();
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = $this->orderService->showOrder($id);
        return $this->response->withData($order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(OrderRequest $request, $id)
    {
        try {
            $this->orderService->updateOrder([
                'id' => $id,
                'status' => $request->status,
                'payment_method' => $request->payment_method,
                'payment_type' => $request->payment_type,
                'user_id' => $request->user_id,
            ]);
            return $this->response->withMessage('Cập nhật thành công');
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->orderService->deleteOrder($id);
            return $this->response->withMessage('Xoá thành công');
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }
}
