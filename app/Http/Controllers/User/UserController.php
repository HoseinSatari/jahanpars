<?php

namespace App\Http\Controllers\User;

use App\code;
use App\Events\resetpasswordSms;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class UserController extends Controller
{
    public function index()
    {
        $this->seo()->setTitle('پنل کاربری')->setDescription('صفحه پنل کاربری جهانپارس');
        return view('user.profile', ['user' => auth()->user()]);
    }

    public function update(User $id, Request $request)
    {
        $request->session()->flash('user_edit', 1);
        $data = $request->validate([
            'phone' => ['required', 'numeric', 'ir_mobile:zero', Rule::unique('users', 'phone')->ignore(auth()->user()->id)],
            'address' => ['required', 'string'],
            'password' => ['nullable', 'min:8']
        ]);


        $id->update([
            'address' => $data['address'],
            'password' => $data['password'] ?? $id->password,
        ]);

        if ($request->phone !== $id->phone) {
            $code = code::generateCode($id);
            event(new resetpasswordSms($request->phone , $code));
            $request->session()->flash('auth', ['user' => $id->id, 'phone' => $request->phone, 'code' => $code]);
            return redirect(route('user.valid.code'));
        }
        toastr()->success('اطلاعات شما با موفقیت ذخیره شد');
        return back()->with('user_edit', 1);

    }

    public function valid(Request $request)
    {
        if (session()->has('auth')) {
            $request->session()->reflash();
            $this->seo()->setTitle(' تایید کد');
            return view('user.valid');
        } else {
            return redirect(route('profile'))->with(['user_edit' => 1]);
        }
    }

    public function valid_code(Request $request)
    {
        if ($request->session()->has('auth')) {
            $data = $request->validate([
                'code' => 'required',
            ], [], ['code' => 'کد']);

            $user = User::findOrFail($request->session()->get('auth.user'));

            $status = code::verifyCode($data['code'], $user);

            if (!$status) {
                toastr()->error('کد وارد شده صحیح نبود.');
                return redirect(route('profile'))->with('user_edit', 1);
            }
            $user->update(['phone' => $request->session()->get('auth.phone')]);

            $user->activeCode()->delete();
            toastr()->success('شماره موبایل شما با موفقیت تایید شد');
            if ($request->session()->has('phone'))
                return redirect($request->session()->get('phone.route'));
            return redirect(route('profile'))->with('user_edit', 1);
        } else {
            toastr()->error('شما اجازه دسترسی به صفحه رو ندارید');
            return redirect(route('profile'))->with('user_edit', 1);
        }
    }

    public function phone(Request $request)
    {
        if ($request->session()->has('phone')) {
            $request->session()->reflash();
            $this->seo()->setTitle('ثبت شماره');
            return view('user.phone');
        }else{
            toastr()->error('مدت زمان حظور شما در صفحه قبلی تمام شد');
            return redirect(route('home'));
        }
    }

    public function valid_phone(Request $request)
    {
        if ($request->session()->has('phone')) {
             $request>session()->reflash();
           $data = $request->validate([
                'phone' => ['required', 'numeric', 'ir_mobile:zero' , 'unique:users'],
            ]);
           
            $id = auth()->user();
            $code = code::generateCode($id);
            event(new resetpasswordSms($request->phone , $code));
            $request->session()->flash('auth', ['user' => $id->id, 'phone' => $data['phone'], 'code' => $code]);
            return redirect(route('user.valid'));
        }else{
            toastr()->error('مدت زمان حظور شما در صفحه قبلی تمام شد');
            return redirect(route('home'));
        }

    }

}
