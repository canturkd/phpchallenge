<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Api\DevicePayment
 *
 * @property int $device_id
 * @property int $app_id
 * @property  int $price
 * @property  int $status
 * @property  string $currency
 *
 * @property-read DeviceApplication $deviceApplication
 */
class DevicePayment extends Model
{

    protected  $table = 'device_payments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'device_id',
        'app_id',
        'price',
        'currency',
        'status',   // 1 -> success, 2 -> failed
    ];

    /**
     * @return BelongsTo
     */
    public function device(): BelongsTo
    {
        return $this->belongsTo(Device::class,'device_id');
    }

    /**
     * @return BelongsTo
     */
    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class,'app_id');
    }


}
