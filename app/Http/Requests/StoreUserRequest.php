<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'country' => 'required|string|max:100',
            'gender' => 'required|string|in:male,female,other',
            'password' => 'required|string|confirmed|min:8',
            'selfie' => 'nullable|image|max:2048',
            'introduction' => 'nullable|string',
        ];
    }
}
