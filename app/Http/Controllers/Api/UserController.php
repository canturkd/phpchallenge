<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\DeviceFormRequest;
use App\Models\Api\Device;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class UserController extends BaseController
{
    /**
     * @param DeviceFormRequest $request
     * @return JsonResponse
     */
    public function register(DeviceFormRequest $request): JsonResponse
    {
        $device = new Device();

        $user = User::create([
            'name' => $request['name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
        ]);

        $api_token = $user->createToken('auth-token')->plainTextToken;

        $device->fill([
            'uuid' => $request['uuid'],
            'os_type' => $request['os_type'],
        ]);

        $device->save();

        return response()->json([
            'status' => '200',
            'token' => $api_token,
            'device_id' => $device->id,
        ]);

    }

}
