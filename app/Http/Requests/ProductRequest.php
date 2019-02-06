<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
        'name' => 'required|max:100',
        'desc'  => 'required',
        'img' => 'required|image|max:1024',
        'categories' => 'required|max:1',
        ];


    }

    public function messages()
    {
         return [
        'name.required' => 'Name required',
        'name.max'      => 'Maximal character 100',
        'desc.required' => 'Description required',
        'categories.required' => 'Category required',
        'categories.max' => 'Maximal category 1 option',
        'img.image' =>  'File must be type image',
        'img.uploaded'  => 'Image failed to upload / image too large, maximal size 1 gb',
        'img.required'  => 'Image Required',
        'img.max'       => 'Maximal Size 1GB',
        ];

    
    }
}
