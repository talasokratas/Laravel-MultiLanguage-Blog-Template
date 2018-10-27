<?php

namespace App\Http\Requests;

use App\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PostRequest extends FormRequest
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
        'post_title'        => 'required',
        'post_slug'         => 'required|alpha_dash|max:200|unique:posts,post_slug,' . $this->id,
        'post_content'      => 'required',
        'post_locale'            => 'required|max:2',
        ];
    }

    public function messages()
    {
        return [
         //
        ];
    }
}
