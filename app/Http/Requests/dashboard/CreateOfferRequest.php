<?php

namespace App\Http\Requests\dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CreateOfferRequest extends FormRequest
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
        // dd(date('d M, Y')) ;
        $rules = [
            'from'       =>'required',
            'to'         =>'required',
            'type'       =>'required|string',
            'gender'     =>'required',
            'note'       =>'string',
            'user_id'    =>'required|integer|exists:user,id',
            'category_id'=>'required|integer|exists:categories,id'
        ];
        return  $rules;
    }
}
