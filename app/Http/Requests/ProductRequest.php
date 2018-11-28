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
        'categories' => 'required|max:1',
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
        'categories.max' => 'Maximal Category 1 Option',
        'img.uploaded'  => 'Image failed to upload / Image too large, Maximal Size 1GB',
        'img.required'  => 'Image Required',
        'img.max'       => 'Maximal Size 1GB',
        'price.required'=> 'Price Required',
        ];
   
        return $messages;

    }

}
