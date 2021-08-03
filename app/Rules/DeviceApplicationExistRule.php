<?php

namespace App\Rules;

use App\Models\Api\Application;
use Illuminate\Contracts\Validation\Rule;

class DeviceApplicationExistRule implements Rule
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
        return (bool) Application::value('id');
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.exists', ['attribute' => 'application']);
    }
}
