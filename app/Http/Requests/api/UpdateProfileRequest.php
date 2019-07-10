<?php

namespace App\Http\Requests\api;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\REQUEST_API_PARENT;
class UpdateProfileRequest extends REQUEST_API_PARENT
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
            'name'     =>'required|string',
            'email'    =>'required|email|unique:user,email',
            'phone'    =>'required|string|unique:user,phone',
            'address'  =>'required|string',
            'image'    =>'image|mimes:jpeg,png,jpg|max:5120',
            'linked_in'=>'URL',
            'bref'     =>'string',
        ];
    }
}
