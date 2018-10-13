<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\DB;

use App\Models\User;

use Toastr;
use Auth;
use Socialite;

class SocialAuthController extends Controller
{
    public function redirect($service)
    {

        return Socialite::driver($service)->redirect();

    }

    public function callback($service, Request $request)
    {

        $user = Socialite::driver($service)->user();

        $authUser = $this->findOrCreateUser($user, $service);

        Auth::guard('web')->login($authUser, true);

        return redirect('/');

    }

    public function findOrCreateUser($user, $service)
    {

        Toastr::info("Welcome ! " . $user->name);

        $authUser = User::where('provider_id', $user->id)->first();

        if ($authUser) 

            return $authUser;

        $slug = str_slug($user->name, '-');

        $user_check_slug = User::where('slug', $slug)->first();

        if ($user_check_slug != null) 
            $slug = $slug . '-' .time();
       
        return User::create([
            'username' => $user->name,
            'email'    => $user->email,
            'provider' => $service,
            'provider_id' => $user->id,
            'avatar' => $user->avatar,
            'slug' => $slug
        ]);

    }

    public function logout()
    {

        Toastr::info("You're logged out!");

        Auth::guard('web')->logout();

        return redirect(route('app.index'));

    }

}
