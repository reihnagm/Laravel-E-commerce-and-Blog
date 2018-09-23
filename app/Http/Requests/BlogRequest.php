<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
{
    
    public function authorize()
    {

        return true;

    }

    public function rules()
    {

        return [
            'title' => 'required|max:100',
            'desc'  => 'required',
            'img' => 'required',
            'tags' => 'required|min:1|max:3',
        ];

    }

    public function messages()
    {

        return [
            'title.required' => 'Title Required',
            'title.max'      => 'Maximal character 100',
            'desc.required' => 'Description Required',
            'tags.required' => 'Tags Required',
            'img.required'  => 'Image Required',
        ];

    }

}
