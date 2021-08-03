<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Api\ApplicationResource;
use App\Models\Api\Application;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller as BaseController;

class ApplicationController extends BaseController
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $device = \DB::table('applications')->get();

        return ApplicationResource::collection($device);
    }

    /**
     * @param int $id
     * @return ApplicationResource
     */
    public function show(int $id): ApplicationResource
    {
        $application = new Application();

        return new ApplicationResource($application->find($id));
    }

}
