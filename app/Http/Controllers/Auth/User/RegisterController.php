<?php

namespace App\Http\Controllers\Auth;

use Gravatar;

use App\Models\User;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{

    use RegistersUsers;

    protected $redirectTo = '/';

    public function __construct()
    {

        $this->middleware('guest');

    }


    protected function validator(array $data)
    {

        return Validator::make($data, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

    }

    protected function create(array $data)
    {

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'slug' => str_slug($data['name'], '-'),
            'avatar' =>  Gravatar::src('wavatar'),
            'password' => Hash::make($data['password']),
        ]);

    }

}
