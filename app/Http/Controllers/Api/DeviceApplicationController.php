<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\DeviceApplicationFormRequest;
use App\Http\Resources\Api\DeviceApplicationResource;
use App\Repositories\Contracts\DeviceRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class DeviceApplicationController extends BaseController
{
    private DeviceRepositoryInterface $deviceRepositories;

    /**
     * Boot repositories
     */
    public function __construct()
    {
        /** @var DeviceRepositoryInterface $deviceRepositories */
        $this->deviceRepositories = app(DeviceRepositoryInterface::class);
    }

    /**
     * @param DeviceApplicationFormRequest $request
     * @return DeviceApplicationResource
     */
    public function store(DeviceApplicationFormRequest $request): DeviceApplicationResource
    {
        return new DeviceApplicationResource($this->deviceRepositories->store($request->all()));

    }

    /**
     * @return JsonResponse
     */
    public function report(): JsonResponse
    {
        return response()->json([
            'data' => $this->deviceRepositories->reportPayments(),
        ]);
    }

}
