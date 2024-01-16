<?php

namespace App\Http\Requests;

use App\Models\Patient;
use Illuminate\Foundation\Http\FormRequest;

class PatientRegisterRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'nid' => ['required', 'string', 'max:28', 'min:10', 'unique:'.Patient::class],
            'phone' => ['required', 'string', 'max:28', 'min:8', 'unique:'.Patient::class],
            'vaccine_center_id' => ['required', 'exists:vaccine_centers,id'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:56', 'unique:'.Patient::class],
        ];

    }
}
