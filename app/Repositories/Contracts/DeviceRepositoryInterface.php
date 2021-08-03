<?php

namespace App\Repositories\Contracts;

interface DeviceRepositoryInterface
{

    public function get($id);

    public function all();

    public function delete($id);

}
