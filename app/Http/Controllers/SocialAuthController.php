<?php

namespace App\Http\Controllers;

use Toastr;
use Socialite;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

use App\Models\User;

class SocialAuthController extends Controller
{
    public function redirect($service)
    {
        return Socialite::driver($service)->redirect();
    }

    public function callback($service, Request $request)
    {
        $user = Socialite::driver($service)->stateless()->user();

        $authUser = $this->findOrCreateUser($user, $service);

        auth()->guard('web')->login($authUser, true);

        return redirect('/');
    }

    public function findOrCreateUser($user, $service)
    {
        $checkUser = User::where('provider_id', $user->id)->first();

        if ($checkUser) {
            return $checkUser;
        }

        $name = $user->name;

        $user_check_name = User::where('name', $user->name)->first();

        if ($user_check_name != null) {
            $name = $name . ' - ' .time();
        }

        return User::create([
            'name' => $name,
            'email'=> $user->email,
            'slug' => $name,
            'provider' => $service,
            'provider_id' => $user->id,
            'avatar' => str_replace('data:image/png;base64,', '', $user->avatar),
        ]);
    }

    public function logout()
    {
        auth()->guard('web')->logout();

        return redirect('/');
    }
}
