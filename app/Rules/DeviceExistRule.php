<?php

namespace App\Rules;

use App\Models\Api\Device;
use Illuminate\Contracts\Validation\Rule;

class DeviceExistRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return (bool) Device::where('id',$value)->get('id');
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.exists', ['attribute' => 'device']);
    }
}
