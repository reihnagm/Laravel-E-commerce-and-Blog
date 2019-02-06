<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Socialite;

use App\Http\Controllers\Controller;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver('google')->user();

        $authUser = $this->findOrCreateUser($user, $provider);

        Auth::login($authUser, true);

        try {
            $user = Socialite::driver($provider)->user();
            return redirect('/');
        } catch (GuzzleHttp\Exception\ClientException $e) {
            dd($e->response);
        }
    }

    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }
        return User::create([
          'name'     => $user->name,
          'email'    => $user->email,
          'provider' => $provider,
          'provider_id' => $user->id
      ]);
    }
}
