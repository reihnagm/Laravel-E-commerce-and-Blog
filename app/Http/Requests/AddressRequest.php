<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{

  public function authorize()
  {

      return true;

  }

  public function rules()
  {

      return [
          'addressline'=>'required',
          'city'=> 'required',
          'state'=> 'required',
          'zip'=> 'required|integer',
          'phone'=> 'required|numeric',
      ];

  }

  public function messages()
  {

      return [
          'addressline.required' => 'Addressline Reqired',
          'city.required' => 'City Reqired',
          'state.required' => 'State Required',
          'zip.required'  => 'Zip Required',
          'phone.required' => 'Phone Required',
          'zip.integer' => 'Zip Must be an number',
          'phone.integer' => 'Phone Must be an number',
      ];

  }

}
