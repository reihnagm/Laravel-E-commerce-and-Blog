<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;

class ProductRequest extends FormRequest
{

    public function authorize()
    {

        return true;

    }

    public function rules()
    {

        $rules = [
        'name' => 'required|max:100',
        'desc'  => 'required',
        'img' => 'required|file|max:1024',
        'categories' => 'required|min:1|max:3',
        'price' => 'required',
        ];

        return $rules;

    }

    public function messages()
    {

       $messages = [
        'name.required' => 'Name Required',
        'name.max'      => 'Maximal Character 100',
        'desc.required' => 'Description Required',
        'categories.required' => 'Category Required',
        'img.uploaded'  => 'Image failed to upload / image too large',
        'img.required'  => 'Image Required',
        'img.max'       => 'Maximal Size 1GB',
        'price.required'=> 'Price Required',
        ];
   
        return $messages;

    }

}
