<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // You can implement authorization logic if needed
        return true; // Allow all users to make this request
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // Check if we are updating an existing user (when a 'user' route parameter exists)
        $userId = $this->route('user') ? $this->route('user')->id : null;

        return [
            'name' => 'required|string|max:255',

            // Email should be unique except for the user being updated
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $userId],

            // Password validation: only required if it's being updated or created
            'password' => ['nullable', 'string', 'min:6', 'confirmed'], // 'nullable' to allow leaving it blank for update

            // Employer field: required for both user and admin
            'employer' => ['required', 'string', 'max:255'],

            // Logo field: required during creation, but nullable during update (optional for update)
            'logo' => [
                'nullable',  // Allow logo to be optional for updating the user
                'file',
                'mimes:png,jpg,jpeg,webp',
                'max:2048' // Max 2MB
            ],
        ];
    }


    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'logo.mimes' => 'The logo must be a file of type: png, jpg, jpeg, webp.',
            'logo.max' => 'The logo file size must not exceed 2MB.',
            // You can add custom messages for other fields here
        ];
    }
}
