<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show_user')->only(['index']);
        $this->middleware('can:create_user')->only(['create', 'store']);
        $this->middleware('can:update_user')->only(['edit', 'update']);
        $this->middleware('can:delete_user')->only(['destroy']);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::query();
        if ($keyword = \request('search')) {
            $users = $users->where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('phone', 'LIKE', "%{$keyword}%")
                ->orWhere('email', 'LIKE', "%{$keyword}%");
        }
        if (\request('admin') == 1) {
            $users = $users->where('is_superuser', 1)
                ->orWhere('is_staff', '1');
        }
        $users = $users->latest()->paginate(20);
        $users->appends(\request()->query())->links();

        return view('panel.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'name' => ['required', 'string'],
            'phone' => ['required', 'numeric', 'ir_mobile:zero', 'unique:users'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8']
        ]);

        $user = User::create($data);

        if ($request->has('is_staff')) {
            $user->update([
                'is_staff' => 1,
            ]);
        }

        if ($request->has('is_active')) {
            $user->markEmailAsverified();
        }
        toastr()->success('با موفقیت ثبت شد.');
        return redirect(route('admin.user.index'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\user $user
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user)
    {
        return view('panel.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\user $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'phone' => ['required', 'numeric', 'ir_mobile:zero', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
        ]);

        if (!is_null($request->password)) {
            $request->validate([
                'password' => ['required', 'string', 'min:8'],
            ]);
            $data['password'] = $request->password;

        }
        $user->update($data);
        $request->has('is_staff') ? $user->update(['is_staff' => 1,]) : $user->update(['is_staff' => 0,]);
        $request->has('is_active') ? $user->markEmailAsverified() : $user->update(['email_verified_at' => null,]);

        toastr()->success('با موفقیت ویرایش شد.');
        return redirect(route('admin.user.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\user $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $user)
    {
        $user->delete();
        toastr()->success('با موفقیت حذف شد.');
        return back();
    }
}
