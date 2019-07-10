<?php

namespace App\Http\Requests\dashboard;

use Illuminate\Foundation\Http\FormRequest;

class EditUserOfferRequest extends FormRequest
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
            'price'=>'required|string',
            'details'=>'required|string',
            // 'offer_id'=>'required|numeric|exists:offers,id',
            'from_user'=>'required|numeric|exists:user,id',
            'to_user'=>'required|numeric|exists:user,id',
        ];
        return  $rules;
    }
}
