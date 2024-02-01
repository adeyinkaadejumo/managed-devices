<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddDeviceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'form_factor' => [
                'required',
                'in:Phone,Tablet',
            ],
            'serial_number' => [
                'required',
            ],
            'imei' => [
                'required',
            ],
            'device_manufacturer_id' => [
                'required',
                'exists:App\Models\DeviceManufacturer,id',
            ],
            'device_model_id' => [
                'required',
                'exists:App\Models\DeviceModel,id',
            ],
            'operating_system' => [
                'required',
                'in:Android,iOS',
            ],
            'user_id' => [
                'required',
                'exists:App\Models\User,id',
            ],
            'sim_card_id' => [
                'required',
                'exists:App\Models\SimCard,id',
            ],
        ];
    }
}
