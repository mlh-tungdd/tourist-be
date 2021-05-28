<?php

namespace App\Http\Requests;
use Illuminate\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class DiscountRequest extends BaseFormRequest
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
        $code = [
            'required',
            'max:255',
            Request::Route('id') != null ? 'unique:discounts,code,' . Request::Route('id') : 'unique:discounts,code'
        ];
        return [
            'discount' => 'required',
            'code' => $code,
        ];
    }

    public function messages()
    {
        return [
            "code.unique" => "Code is exist",
        ];
    }
}
