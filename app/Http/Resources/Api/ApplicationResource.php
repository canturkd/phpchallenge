<?php


namespace App\Http\Resources\Api;

use App\Models\Api\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @mixin Application
 *
 * @extends JsonResource<Application>
 */
class ApplicationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     *
     * @return array
     */
    #[ArrayShape(['name' => "string", 'type' => "string", 'price' => "string"])]
    public function toArray($request): array
    {
        return [
            'name' => $this->name,
            'type' => $this->type,
            'price' => $this->price,
        ];
    }

}
