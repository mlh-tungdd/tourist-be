<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Http\Requests\RoomRequest;
use App\Services\RoomServiceInterface;

class RoomController extends ApiController
{
    protected $roomService;
    protected $response;
    protected $folder = 'rooms';

    /**
     * construct function
     *
     * @param RoomServiceInterface $room
     * @param ApiResponse $response
     */
    public function __construct(RoomServiceInterface $roomService, ApiResponse $response)
    {
        $this->roomService = $roomService;
        $this->response = $response;
    }

    /**
     * Display a all of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all($id)
    {
        $list = $this->roomService->getAllRoomByHotelId([
            'id' => $id
        ]);
        return $this->response->withData($list);
    }

    /**
     * Display a all of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllRoomByHotelId($id)
    {
        $list = $this->roomService->getListRoom([
            'id' => $id
        ]);
        return $this->response->withData($list);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoomRequest $request)
    {
        try {
            $fileName = null;
            if ($request->hasFile('thumbnail')) {
                $filenameByRequest = $request->file('thumbnail')->getClientOriginalName();
                $fileName = pathinfo($filenameByRequest, PATHINFO_FILENAME);
                $extension = $request->file('thumbnail')->getClientOriginalExtension();
                $fileName = $fileName . '_' . time() . '.' . $extension;

                $request->file('thumbnail')->move(public_path('images/' . $this->folder), $fileName);
            }

            $this->roomService->createRoom([
                'name' => $request->name,
                'area' => $request->area,
                'space' => $request->space,
                'position' => $request->position,
                'options' => $request->options,
                'price' => $request->price,
                'qty' => $request->qty,
                'note' => $request->note,
                'convenients' => $request->convenients,
                'hotel_id' => $request->hotel_id,
                'thumbnail' => env('APP_URL') . "/images/" . $this->folder . '/' . $fileName,
            ]);
            return $this->response->withCreated();
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $room = $this->roomService->showRoom($id);
        return $this->response->withData($room);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(RoomRequest $request, $id)
    {
        try {
            if ($request->hasFile('thumbnail')) {
                $filenameByRequest = $request->file('thumbnail')->getClientOriginalName();
                $fileName = pathinfo($filenameByRequest, PATHINFO_FILENAME);
                $extension = $request->file('thumbnail')->getClientOriginalExtension();
                $fileName = $fileName . '_' . time() . '.' . $extension;

                $request->file('thumbnail')->move(public_path('images/' . $this->folder), $fileName);

                $this->roomService->updateRoom([
                    'id' => $id,
                    'thumbnail' => env('APP_URL') . "/images/" . $this->folder . '/' . $fileName,
                ]);
            }

            $this->roomService->updateRoom([
                'id' => $id,
                'name' => $request->name,
                'area' => $request->area,
                'space' => $request->space,
                'position' => $request->position,
                'options' => $request->options,
                'price' => $request->price,
                'qty' => $request->qty,
                'note' => $request->note,
                'convenients' => $request->convenients,
                'hotel_id' => $request->hotel_id,
            ]);
            return $this->response->withMessage('Cập nhật thành công');
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->roomService->deleteRoom($id);
            return $this->response->withMessage('Xoá thành công');
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }
}
