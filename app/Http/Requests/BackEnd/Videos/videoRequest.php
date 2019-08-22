<?php

namespace App\Http\Requests\BackEnd\Videos;

use Illuminate\Foundation\Http\FormRequest;

class videoRequest extends FormRequest
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
            'name' => 'required|max:191',
            'des' => 'required|max:191',
            'meta_des' => 'nullable|max:191',
            'meta_keywords' => 'nullable|max:191',
            'youtube' => 'required|min:10|url',
            'cat_id' => 'required|integer',
            'published' => 'required',
            'image' => 'nullable'
        ];
    }
}
