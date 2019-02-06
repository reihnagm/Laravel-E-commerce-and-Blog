<?php

namespace App\Http\Controllers;

use JWTAuth;
use Cookie;

use Tymon\JWTAuth\Exception\JWTException;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests;
use App\Models\User;

class AuthController extends Controller
{
    public function signup(Request $request)
    {

        $this->validate($request, [
          'name' => 'required',
          'email' => 'required|string|email|unique:users',
          'password' => 'required|string|min:8',
        ]);

        return User::create([
          "name" => $request->json('name'),
          "email" => $request->json('email'),
          "password" => bcrypt($request->json('password')),
        ]);

    }

    public function signin(Request $request)
    { 
      
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized.'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Invalid create token.'], 500);
        }

        return response()->json([
          'user_id' => $request->user()->id,
          'jwt_token' => $token 
         ])->withCookie('jwt_token', $token, 60)
           ->withCookie('user_id', $request->user()->id, 60);

    }

    public function signout() 
    {

      return redirect('/')->withCookie(Cookie::forget('jwt_token'));

    }

  
    
}
