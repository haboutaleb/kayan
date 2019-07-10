<?php

namespace App\Http\Requests\dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
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
            'name_ar'=>'required|string',
            'name_en'=>'required|string',
            'image' =>'required|image|mimes:jpeg,png,jpg|max:5120',
            'description_ar'=>'required|string',
            'description_en'=>'required|string'
        ];
        return  $rules;
    }
}
