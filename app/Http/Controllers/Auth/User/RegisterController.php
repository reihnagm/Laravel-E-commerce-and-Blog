<?php

namespace App\Http\Controllers\Auth;

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

    public function showRegistrationForm()
    {

      return redirect(route('app.index'));

    }

    protected function validator(array $data)
    {

        return Validator::make($data, [
            'username' => 'required|string|max:15',
            'email' => 'required|string|email|max:50|unique:users',
            'password' => 'required|string|min:6|max:255|confirmed',
        ]);

    }

    protected function create(array $data)
    {

        return User::create([
            'username' => $data['username'],
            'slug' => str_slug($data['username'], '-'),
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

    }

}
