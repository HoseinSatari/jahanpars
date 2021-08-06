<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
      
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {

        try {
            $googleuser = Socialite::driver('google')->user();
            $user = User::where('email' , $googleuser->email)->first();
            if ($user){
                auth()->loginUsingId($user->id);
            }else{
                $newuser = User::create([
                    'name' => $googleuser->name,
                    'email' => $googleuser->email,

                ]);
                auth()->loginUsingId($newuser->id);
            }
            return redirect('/');
        }catch (\Exception $e){
            alert()->error('متاسفانه مشکلی در ورود با گوگل به وجود امده لطفا دوباره تلاش کنید یا از روش عادی استفاده نمایید.', 'خطا');
            return redirect(route('login'));
        }
    }
}
