<?php
namespace App\Jobs;

use App\Models\Api\DeviceApplication;
use App\Models\Api\DevicePayment;
use App\Repositories\Contracts\DeviceRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class Payment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $currency;

    private DeviceRepositoryInterface $deviceRepositories;

    private DeviceApplication $deviceApplication;


    /**
     * Payment constructor.
     * @param DeviceRepositoryInterface $deviceRepositories
     * @param DeviceApplication $deviceApplication
     * @param string $currency
     */
    public function __construct(DeviceRepositoryInterface $deviceRepositories, DeviceApplication $deviceApplication, string $currency = 'TL')
    {
        $this->deviceRepositories = $deviceRepositories;
        $this->deviceApplication = $deviceApplication;
        $this->currency     = $currency;
    }

    public function handle()
    {
        $rndHash = \Hash::make(\Str::random(30)).rand(1,100);
        $successPayment = intval(substr($rndHash, -1)) % 2;

        try {

            $devicePayment = new DevicePayment();

            $devicePayment->app_id = $this->deviceApplication->app_id;
            $devicePayment->device_id = $this->deviceApplication->device_id;
            $devicePayment->price      = $this->deviceApplication->application->price;
            $devicePayment->currency   = $this->currency;
            $devicePayment->status     = 0;

            if ($successPayment) {
                $devicePayment->status = 0;
            }

            $devicePayment->save();

            if ($successPayment) {
                $this->deviceRepositories->setApplicationExpireDate($this->deviceApplication, now());
            } else {
                $this->deviceRepositories->checkNoPayments($devicePayment->device_id);
            }

            return 1;

        } catch (\Exception $e) {
            \Log::info('Payment Job Error', [$this->deviceApplication]);

            return 0;
        }
    }
}
