<?php

namespace App\Http\Requests\posts;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
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
            'title' => ['required',
            Rule::unique('posts')->ignore($this->post->id)
        ],
            'description' => 'required',
            'content' => 'required',
            'category_id' => 'required|numeric'
        ];
    }
}
