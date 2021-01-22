<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class TourRequest extends BaseFormRequest
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
        $roll_number = [
            'required',
            'max:100',
            Request::Route('id') != null ? 'unique:tours,roll_number,' . Request::Route('id') : 'unique:tours,roll_number'
        ];
        return [
            'title' => 'required|max:255',
            'roll_number' => $roll_number
        ];
    }

    public function messages()
    {
        return [
            "roll_number.unique" => "Roll number is exist",
        ];
    }
}