<?php

namespace App\Console\Commands;

use App\Jobs\Payment;
use App\Models\Api\DeviceApplication;
use App\Repositories\Contracts\DeviceRepositoryInterface;
use Illuminate\Console\Command;

class CheckPayments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payments:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        /** @var DeviceRepositoryInterface $deviceRepository */
        $deviceRepository = app(DeviceRepositoryInterface::class);

        $checkApplications = DeviceApplication::where('end_date','<',today())->get();

        foreach ($checkApplications as $checkApplication) {

            $job = new  Payment($deviceRepository, $checkApplication,'TL');

            dispatch($job);
        }

        return 0;
    }
}
