<?php

namespace App\Http\Requests\dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CountryUpdate extends FormRequest
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
            'name_ar'=>'sometimes|string',
            'name_en'=>'sometimes|string',
            'show_key'=>'sometimes|string',
            'tel_key'=>'sometimes|numeric',
            'continent'=>'sometimes',
            'image'=>'sometimes|image',
        ];
    }
}
