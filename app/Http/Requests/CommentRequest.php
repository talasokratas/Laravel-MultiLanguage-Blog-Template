<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'comment_author'        => 'required',
            'comment_author_email'  => 'required|email',
            'comment_author_url'    => 'sometimes|required',
            'comment_content'       => 'required'
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }
}
