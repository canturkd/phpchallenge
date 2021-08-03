<?php

namespace App\Models\Api;

use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Api\Device
 *
 * @property  string $uuid
 * @property  string $os_type
 * @property  string $lang
 * @property  int    $id
 * @property  Carbon $deleted_at
 *
 * @mixin Eloquent
 * @property-read DeviceApplication $deviceApplication
 * @property-read DevicePayment $devicePayment
 *
 */
class Device extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'devices';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'os_type',
    ];

    /**
     * @return HasMany
     */
    public function deviceApplication(): HasMany
    {
        return $this->hasMany(DeviceApplication::class,'device_id');
    }

    /**
     * @return HasMany
     */
    public function devicePayment(): HasMany
    {
        return $this->hasMany(DevicePayment::class,'device_id');
    }
}
