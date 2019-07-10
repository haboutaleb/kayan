<?php

namespace App\Http\Requests\api;

use App\Http\Requests\REQUEST_API_PARENT;

class RegisterRequest extends REQUEST_API_PARENT
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
            'name'=>'required|string',
            'type'=>'required|string',
            'mobile'=>'required|unique:user,mobile',
            'email'=>'required|email|unique:user,email',
            'longitude'=>'required|lang_lat',
            'latitude'=>'required|lang_lat',
            'password'=>'required|string|confirmed',
        ];

    }
}
