<?php

namespace App\Http\Requests\dashboard;

use Illuminate\Foundation\Http\FormRequest;

class EditOfferRequest extends FormRequest
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

        $rules = [
            'from'       =>'required|date_format:Y-m-d',
            'to'         =>'required|date_format:Y-m-d',
            'type'       =>'required|string',
            'gender'     =>'required|string',
            'note'       =>'string',
            'user_id'    =>'required|integer|exists:user,id',
            'category_id'=>'required|integer|exists:categories,id'
        ];
        return  $rules;
    }
}
