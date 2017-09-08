<?php

namespace App\Http\Controllers\Auth;

use URL;
use Hash;
use Auth;
use Session;
use Request;
use App\User;
use Redirect;
use Socialite;
use App\Http\Controllers\Controller;

class GoogleAuthController extends Controller
{

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        $scopes = ['public_profile', 'user_birthday', 'email'];
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from google.
     *
     * @return Response
     */
    public function handleProviderCallback(Request $request)
    {
        try{
            $user = Socialite::driver('google')->stateless()->user();
        } catch (\Exception $e) {
            return redirect('/login')->with('status', 'Something went wrong or You have rejected the app!');
        }

        if($user){

            $mail = $user->email;

            if (!$this->mailAlreadyExists($mail)) {

                $newUser = new User;
                $newUser->email = $user->getEmail();
                $newUser->avatar = $user->getAvatar();
                $newUser->provider = 'google';
                $newUser->provider_id = $user->getId();
                $newUser->name = $user->getName();
                $newUser->password = Hash::make(str_random(16));

                $newUser->save();

                Auth::login($newUser, true);
                return Redirect::to('/');

            } elseif($this->mailAlreadyExists($mail)) {

                $preExistingUser = User::where('email', '=', $mail)->first();

                if( !$preExistingUser->name ) $preExistingUser->name = $user->name;
                $preExistingUser->provider = "google";
                $preExistingUser->provider_id = $user->id;

                $preExistingUser->save();

                Auth::login($preExistingUser, true);

                return Redirect::to('/');
            }

            return Redirect::to('/');

        } else{
            return 'something went wrong';
        }
    }

    private function mailAlreadyExists($mail)
    {
         return User::where('email', '=', $mail)->first() ? true : false;
    }
}
