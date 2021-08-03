<?php

namespace App\Http\Requests;

use App\Rules\DeviceExistRule;
use App\Rules\ApplicationExistRule;
use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class DeviceApplicationFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules(): array
    {
        return [
            'device_id' => [
                'required',
                'int',
                new DeviceExistRule()
            ],
            'app_id' => [
                'required',
                'int',
                new ApplicationExistRule()
            ],
        ];
    }
}
