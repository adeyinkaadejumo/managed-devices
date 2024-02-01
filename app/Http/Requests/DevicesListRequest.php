<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DevicesListRequest extends FormRequest
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
            'operating_system' => [
                'nullable',
                Rule::in(config('constants.operating_systems')),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'operating_system' => "The 'operating_system' parameter accepts only these values: ".implode(', ', config('constants.operating_systems')).'.',
        ];
    }
}
