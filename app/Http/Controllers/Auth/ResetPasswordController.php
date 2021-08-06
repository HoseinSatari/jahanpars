<?php

namespace App\Http\Controllers\Auth;

use App\code;
use App\Events\resetpasswordEmail;
use App\Events\resetpasswordSms;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    public function reset_view()
    {
        return view('auth.passwords.email');
    }

    public function reset_post(\Illuminate\Http\Request $request)
    {

        if (is_numeric($request->get('email'))) {
            $user = User::where('phone', $request->get('email'))->first();
            if (!$user) {
                toastr()->error('کاربری با این مشخصات وجود ندارد');
                return back();
            }
            $code = code::generateCode($user);
            event(new resetpasswordSms($user->phone , $code));
            $request->session()->flash('auth', ['user' => $user->id, 'code' => $code]);
            return redirect(route('user.confirmpass'));


        } elseif (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
            $user = User::where('email', $request->get('email'))->first();
            if (!$user) {
                toastr()->error('کاربری با این مشخصات وجود ندارد');
                return back();
            }
            $code = code::generateCode($user);
            event(new resetpasswordEmail($code , $user->email));
            $request->session()->flash('auth', ['user' => $user->id, 'code' => $code]);

            return redirect(route('user.confirmpass'));
        } else {
            toastr()->error('لطفا فرمت ورودی را رعایت کنید');
            return back();
        }

    }

    public function confirm(\Illuminate\Http\Request $request)
    {
        if (session()->has('auth')) {
            $request->session()->reflash();
            return view('auth.passwords.confirm');
        }

    }

    public function confirm_post(\Illuminate\Http\Request $request)
    {
        if ($request->session()->has('auth')) {
            $data = $request->validate([
                'code' => 'required',
            ], [], ['code' => 'کد']);
            $user = User::findOrFail($request->session()->get('auth.user'));

            $status = code::verifyCode($data['code'], $user);

            if (!$status) {
                toastr()->error('کد وارد شده صحیح نیست یا منقضی شده');
                return redirect(route('user.resetpassword'));
            }
            $user->activeCode()->delete();
            $request->session()->reflash();
            toastr()->success('لطفا کلمه عبور جدید را وارد کنید');
            return redirect(route('user.reset'));
        } else {
            return redirect(route('user.resetpassword'));
        }
    }

    public function reset(\Illuminate\Http\Request $request)
    {
        if ($request->session()->has('auth')) {
            $request->session()->reflash();
            return view('auth.passwords.reset');

        }

    }

    public function resetpass_post(\Illuminate\Http\Request $request)
    {

        if ($request->session()->has('auth')) {
            $request->session()->reflash();

            $data = $request->validate([
                'password' => 'required|confirmed|min:8',
            ]);

            $user = User::findOrFail($request->session()->get('auth.user'));
            $user->update(['password' => $data['password']]);
            toastr()->success('کلمه عبور شما با موفقیت تغییر یافت');
            return redirect(route('login'));

        }



    }
}
