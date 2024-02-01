<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDeviceRequest extends FormRequest
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
            'user_id' => [
                'sometimes',
                'required',
                'exists:App\Models\User,id',
            ],
            'sim_card_id' => [
                'sometimes',
                'required',
                'exists:App\Models\SimCard,id',
            ],
        ];
    }

    public function all($keys = null)
    {
        $allValues = parent::all();

        $allValues['deactivated_at'] = null;

        return $allValues;
    }

    protected function passedValidation()
    {
        // Set the specified key to null after validation
        $this->merge([
            'user_id' => null,
        ]);
    }
}
