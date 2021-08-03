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
class DeviceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     *
     * @return array
     */
     public function toArray($request): array
    {
        return [

            'uuid' => $this->uuid,
            'os_type' => $this->os_type,
            'lang' => $this->lang,
            'status' => $this->deleted_at ? 'passive' : 'active',
        ];
    }

}
