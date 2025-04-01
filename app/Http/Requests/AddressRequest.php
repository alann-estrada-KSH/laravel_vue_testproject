<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            "user_id" => "required|exists:users,id",
            "street" => "required|string",
            "suburb" => "required|string",
            "city" => "required|string",
        ];
    }

    public function messages(): array
    {
        return [
            'street.required' => 'Street is required',
            'suburb.required' => 'Suburb is required',
            "city.required" => 'City is required',
        ];
    }
}
