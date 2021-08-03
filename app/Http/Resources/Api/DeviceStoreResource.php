<?php


namespace App\Http\Resources\Api;


use App\Models\Api\Device;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @mixin Device
 *
 * @extends JsonResource<Device>
 */
class DeviceStoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     *
     * @return array
     */
    #[ArrayShape(['status' => "string", 'token' => "string", 'device_id' => "int"])]
    public function toArray($request): array
    {
        return [
            'status' => '200',
            'token' => $this->api_token,
            'device_id' => $this->id,
        ];
    }

}
