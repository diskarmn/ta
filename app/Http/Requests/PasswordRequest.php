<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return Auth::check();
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'current_password' => 'required',
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed', // Memastikan ada kolom "password_confirmation" yang cocok
                'regex:/^(?=.*[a-zA-Z])(?=.*\d)[A-Za-z\d@$!%*#?%^&]*$/',
            ],
        ];
    }
}