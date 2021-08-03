<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 *  App\Models\Api\Application
 *
 * @property  string $name
 * @property  string $type
 * @property  string $price
 *
 * @property-read DeviceApplication $deviceApplication
 */
class Application extends Model
{
    use HasFactory;

    protected  $table = 'applications';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type',
        'price'
    ];

    /**
     * @return HasMany
     */
    public function applicationDevice(): HasMany
    {
        return $this->hasMany(DeviceApplication::class,'app_id');
    }

    /**
     * @return HasMany
     */
    public function paymentDevice(): HasMany
    {
        return $this->hasMany(DevicePayment::class,'app_id');
    }

}
