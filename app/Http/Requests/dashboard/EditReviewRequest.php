<?php

namespace App\Http\Requests\dashboard;

use Illuminate\Foundation\Http\FormRequest;

class EditReviewRequest extends FormRequest
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
            'review_id'=>'required|integer|exists:reviews,id',
            'user_id'=>'required|integer|exists:user,id',
            'reviewer_id'=>'required|integer|exists:user,id',
            'review'=>'required|integer|digits_between:0,5|numeric'
        ];
    }
}
