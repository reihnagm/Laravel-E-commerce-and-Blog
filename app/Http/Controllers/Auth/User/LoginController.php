<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;

use Toastr;
use Auth;
use Socialite;
use Google_Client;
use Google_Service_People;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {

      $this->middleware('guest')->except('logout', 'getUserAuth', 'delUserAuth'); // if not fillable except then redirect back getUserAuth

    }

    public function showLoginForm()
    {

      return redirect(route('app.index'));

    }

    public function redirectToProvider($provider)
    {
        // return Socialite::driver('google')
      //   ->scopes(['openid', 'profile', 'email', Google_Service_People::CONTACTS_READONLY])
      //   ->redirect();

      // option 2
      // return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        //       $user = Socialite::driver($provider)->user();

          // $user = Socialite::with($provider)->user();
          // return view('app-general/app')->withDetails($user)->withProvider($provider);


          // Set token for the Google API PHP Client
          // $google_client_token = [
          //     'access_token' => $user->token,
          //     'refresh_token' => $user->refreshToken,
          //     'expires_in' => $user->expiresIn
          // ];
          //
          // $client = new Google_Client();
          // $client->setApplicationName("Laravel");
          // $client->setDeveloperKey(env('GOOGLE_SERVER_KEY'));
          // $client->setAccessToken(json_encode($google_client_token));
          //
          // $service = new Google_Service_People($client);
          //
          // $optParams = array('requestMask.includeField' => 'person.phone_numbers,person.names,person.email_addresses');
          // $results = $service->people_connections->listPeopleConnections('people/me',$optParams);
          //
          //
          // dd($user);



        // option 2
        // $user = Socialite::driver('google')->user();

        // $authUser = $this->findOrCreateUser($user, $provider);
        //
        // Auth::login($authUser, true);
        //
        // return redirect('/');

        // try {
        //     $user = Socialite::driver($provider)->user();
        //     return view('app-general/app');
        // }
        // catch (GuzzleHttp\Exception\ClientException $e) {
        //      dd($e->response);
        // }
    }

    public function findOrCreateUser($user, $provider)
    {
        // option 2
        // $authUser = User::where('provider_id', $user->id)->first();
        // if ($authUser) {
        //     return $authUser;
        // }
        // return User::create([
        //     'name'     => $user->name,
        //     'email'    => $user->email,
        //     'provider' => $provider,
        //     'provider_id' => $user->id
        // ]);
    }

}
