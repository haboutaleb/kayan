<?php

namespace App\Http\Requests\api;

use Illuminate\Foundation\Http\FormRequest;

class CreateNewOfferRequest extends FormRequest
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
            //
            'from_date'  =>'required|date_format:d-m-Y',
            'to_date'    =>'required|date_format:d-m-Y|after:from_date',
            'type'       =>'required|string',
            'gender'     =>'required|string',
            'note'       =>'string',
            'category_id'=>'required|integer|exists:categories,id'
        ];
    }
}
