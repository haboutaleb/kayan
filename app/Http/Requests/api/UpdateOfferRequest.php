<?php

namespace App\Http\Requests\api;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\REQUEST_API_PARENT;

class UpdateOfferRequest extends REQUEST_API_PARENT
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
            'offer_id'=>'required|exists:user_offers,id',
            'price'   =>'required|numeric',
            'details' =>'required|string',
        ];
    }
}
