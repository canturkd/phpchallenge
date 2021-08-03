<?php

namespace App\Repositories;

use App\Models\Api\Device;
use App\Models\Api\DeviceApplication;
use App\Models\Api\DevicePayment;
use App\Repositories\Contracts\DeviceRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class DeviceRepositories implements DeviceRepositoryInterface
{
    public function get($id)
    {
    }


    public function all()
    {
    }


    public function delete($id)
    {
    }

    /**
     * @param array $attributes
     * @return DeviceApplication
     */
    public function store(array $attributes): DeviceApplication
    {
        $deviceApplication = new DeviceApplication();

        $startDate = now();
        $attributes['start_date'] =$startDate;

        $deviceApplication->fill($attributes);

        $deviceApplication->save();

        $this->setApplicationExpireDate($deviceApplication, $deviceApplication->start_date);

        return $deviceApplication;
    }


    /**
     * @param DeviceApplication $deviceApplication
     * @param string $endDate
     * @return void
     */
    public function setApplicationExpireDate(DeviceApplication $deviceApplication, string $endDate): void
    {
        if($deviceApplication->application->type == 'weekly') {
            $endDate = Carbon::createFromFormat('Y-m-d H:i:s',$endDate)->addDays(7);
        }

        if($deviceApplication->application->type == 'monthly') {
            $endDate = Carbon::createFromFormat('Y-m-d H:i:s',$endDate)->addMonth();
        }
        if($deviceApplication->application->type == 'yearly') {
            $endDate =Carbon::createFromFormat('Y-m-d H:i:s',$endDate)->addYear();
        }

        $deviceApplication->end_date = $endDate;
        $deviceApplication->save();
    }

    /**
     * @param int|null $deviceId
     */
    public function checkNoPayments(int $deviceId = null)
    {
        $devices = DevicePayment::select(\DB::raw("device_id,count(device_id) AS count"))
            ->groupBy('device_id')
            ->having('count','>=',3)
            ->when($deviceId, function($query, $deviceId) {
                /* @var Builder $query */
                $query->where('device_id', $deviceId);
            })
            ->get()
            ->map(function ($model) {
                return $model->device_id;
            })->toArray();

        $this->setPassive($devices);
    }

    /**
     * @param array $companies
     * @return void
     */
    public function setPassive(array $devices): void
    {
        Device::whereIn('id', $devices)
            ->where('deleted_at',null)
            ->delete();
    }


    /**
     * @return array
     */
    public function reportPayments(): array
    {
        return \DB::table('device_payments')
            ->join('devices', 'devices.id', '=', 'device_payments.device_id')
            ->join('applications', 'applications.id', '=', 'device_payments.app_id')
            ->select([
                'devices.uuid AS UUID',
                'applications.name AS App Name',
                'device_payments.price',
                'device_payments.status',
                'device_payments.created_at AS Payment Date',
            ])
            ->get()
            ->toArray();

    }
}
