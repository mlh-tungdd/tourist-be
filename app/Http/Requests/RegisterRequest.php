<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends BaseFormRequest
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
            'fullname' => 'required|max:255',
            'username' => 'nullable|max:255|alpha_dash|unique:users,username',
            'email' => 'required|email',
            'password' => 'nullable|max:255',
            'password_confirmation' => 'nullable|same:password',
            'phone' => 'nullable|max:15|alpha_num',
        ];
    }
}
