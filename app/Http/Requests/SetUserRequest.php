<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SetUserRequest extends FormRequest
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
            'login' => 'required|between:6,32|alpha',
            'password' =>'required|between:6,32|alpha_dash',
            'role_uuid' => 'required|exists:user_roles,uuid',
            'first_name' => 'required|between:6,32|alpha',
            'last_name' => 'required|between:6,32|alpha',
            'patronymic' => 'required|between:6,32|alpha',
            'email' => 'required|email',
            'phone' => 'required',
            'image' => 'required ',
        ];
    }
}
