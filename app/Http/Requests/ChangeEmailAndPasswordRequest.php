<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeEmailAndPasswordRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {

      $id = request()->user()->id;

      return [
          'email' => "required|email|unique:users,email,$id"
      ];

    }

    public function messages()
    {
      return [
        'email.unique' => "Email Already Exists!"
      ];
    }

}
