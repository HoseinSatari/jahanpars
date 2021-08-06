<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class PermissionUserController extends Controller
{
    public function create(User $id)
    {
        return view('panel.users.permission' , [
            'user' => $id
        ]);
    }

    public function store(Request $request, User $id)
    {
        $id->permissions()->sync($request->permissions);
        $id->rolls()->sync($request->roles);

        alert()->success('دسترسی مورد نظر با موفقیت اعمال شد');
        return redirect(route('admin.user.index'));

    }
}
