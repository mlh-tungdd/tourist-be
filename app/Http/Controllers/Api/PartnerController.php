<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Models\Partner;
use App\Http\Requests\PartnerRequest;
use App\Services\PartnerServiceInterface;

class PartnerController extends ApiController
{
    protected $partnerService;
    protected $response;
    protected $folder = 'partners';

    /**
     * construct function
     *
     * @param PartnerServiceInterface $partner
     * @param ApiResponse $response
     */
    public function __construct(PartnerServiceInterface $partnerService, ApiResponse $response)
    {
        $this->partnerService = $partnerService;
        $this->response = $response;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = $this->partnerService->getListPartner($request->all());
        return $this->response->withData($list);
    }

    /**
     * Display a all of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $list = $this->partnerService->getAllPartner($request->all());
        return $this->response->withData($list);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PartnerRequest $request)
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

            $this->partnerService->createPartner([
                'title' => $request->title,
                'url' => $request->url,
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
     * @param  \App\Models\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $partner = $this->partnerService->showPartner($id);
        return $this->response->withData($partner);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function update(PartnerRequest $request, $id)
    {
        try {
            if ($request->hasFile('thumbnail')) {
                $filenameByRequest = $request->file('thumbnail')->getClientOriginalName();
                $fileName = pathinfo($filenameByRequest, PATHINFO_FILENAME);
                $extension = $request->file('thumbnail')->getClientOriginalExtension();
                $fileName = env('APP_URL') . $fileName . '_' . time() . '.' . $extension;

                $request->file('thumbnail')->move(public_path('images/' . $this->folder), $fileName);

                $this->partnerService->updatePartner([
                    'id' => $id,
                    'thumbnail' => env('APP_URL') . "/images/" . $this->folder . '/' . $fileName,
                ]);
            }

            $this->partnerService->updatePartner([
                'id' => $id,
                'title' => $request->title,
                'url' => $request->url,
            ]);
            return $this->response->withMessage('Update successful');
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->partnerService->deletePartner($id);
            return $this->response->withMessage('Delete successful');
        } catch (Exception $ex) {
            return $this->response->errorWrongArgs($ex->getMessage());
        }
    }
}
