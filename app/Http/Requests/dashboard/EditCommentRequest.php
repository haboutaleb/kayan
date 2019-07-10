<?php

namespace App\Http\Requests\dashboard;

use Illuminate\Foundation\Http\FormRequest;

class EditCommentRequest extends FormRequest
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
            'comment_id' =>'required|integer|exists:comments,id',
            'from_id'    =>'required|integer|exists:user,id',
            'to_id'      =>'required|integer|exists:user,id',
            'comment'    =>'required|string',
        ];
    }
}
