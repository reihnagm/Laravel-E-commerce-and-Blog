<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        $emailValidation = auth()->user() ? 'required|email': 'required|email|unique:users';

        return [
            'email' => $emailValidation,
            'name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'province' => 'required',
            'postalcode' => 'required',
            'phone' => 'required'
        ];
    }


    public function messages()
    {
        return [
        'email.unique' => 'You have already have an account with this email address. Please <a class="button" href="/"> login </a> to continue'
      ];
    }
}
