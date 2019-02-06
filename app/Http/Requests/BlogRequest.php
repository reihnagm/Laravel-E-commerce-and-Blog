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
            'img' => 'required|image|max:1024',
            'tags' => 'required|min:1|max:3',
        ];

    }

    public function messages()
    {

        return [
            'title.required' => 'Title required',
            'title.max'      => 'Maximal character 100',
            'desc.required' => 'Description required',
            'tags.required' => 'Tags required',
            'img.image'     => 'File must be type image',
            'img.required'  => 'Image required',
            'img.max'  => 'Image too large, max 1GB',
            'img.uploaded'  => 'Image failed to upload / image too large',
        ];

    }

}
