<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\DeviceFormRequest;
use App\Http\Resources\Api\DeviceResource;
use App\Http\Resources\Api\DeviceStoreResource;
use App\Models\Api\Device;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller as BaseController;

class DeviceController extends BaseController
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $device = \DB::table('devices')->get();

        return DeviceResource::collection($device);
    }

    /**
     * @param int $id
     * @return DeviceResource
     */
    public function show(int $id): DeviceResource
    {
        $device = new Device();

        return new DeviceResource($device->find($id));
    }

    /**
     * @param DeviceFormRequest $deviceFormRequest
     * @return DeviceStoreResource
     */
    public function store(DeviceFormRequest $deviceFormRequest): DeviceStoreResource
    {
        $device = new Device();

        $deviceFormRequest['api_token'] = $device->createToken('auth-token')->plainTextToken;
        $device->fill($deviceFormRequest->all());

        $device->save();

        return new DeviceStoreResource($device);

    }

}
