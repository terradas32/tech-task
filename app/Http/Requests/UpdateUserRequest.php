<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'surname' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:users,email,' . $this->user->id,
            'phone' => 'sometimes|required|string|max:20',
            'country' => 'sometimes|required|string|max:100',
            'gender' => 'sometimes|required|string|in:male,female,other',
            'password' => 'sometimes|required|string|confirmed|min:8',
            'selfie' => 'nullable|image|max:2048',
            'introduction' => 'nullable|string',
        ];
    }
}
