<?php

namespace App\Models\Api;

use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Api\DeviceApplication
 *
 * @property int $device_id
 * @property int $app_id
 * @property Carbon $start_date
 * @property Carbon $end_date
 *
 * @mixin Eloquent
 *
 * @property-read Device $device
 * @property-read Application $application
 */
class DeviceApplication extends Model
{
    use  HasFactory;
    protected  $table = 'device_applications';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'device_id',
        'app_id',
        'start_date',
        'end_date',
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
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
