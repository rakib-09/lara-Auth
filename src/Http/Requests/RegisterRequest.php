<?php

namespace AppRakib\LaraAuth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'                  => 'required|string|max:40',
            'email'                 => 'required|email|unique:users,email|max:40',
            'password'              => 'required|max:255|min:6|confirmed',
            'password_confirmation' => 'required|max:255|min:6',
            'avatar'                => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }
}
