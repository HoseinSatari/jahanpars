<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show_role')->only(['index']);
        $this->middleware('can:create_role')->only(['create' , 'update']);
        $this->middleware('can:update_role')->only(['edit' , 'update']);
        $this->middleware('can:delete_role')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rolls = role::query();

        if ($keyword = \request()->search) {
            $rolls = $rolls->where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('label', 'LIKE', "%{$keyword}%");
        }
        $rolls = $rolls->latest()->paginate(10);
        $rolls->appends(\request()->query())->links();
        return view('panel.roles.all', compact('rolls'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.roles.create');

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
            'name' => 'required',
            'label' => 'required',
            'permissions' => 'required|array',
        ]);
        $role = role::create($data);
        $role->permissions()->sync($data['permissions']);
        alert()->success('مقام با موفقیت ایحاد شد');
        return redirect(route('admin.Role.index'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function edit(role $Role)
    {
        return view('panel.roles.edit', compact('Role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, role $Role)
    {
        $data = $request->validate([
            'name' => 'required',
            'label' => 'required',
            'permissions' => 'required|array',
        ]);
        $Role->update($data);
        $Role->permissions()->sync($data['permissions']);
        alert()->success('مقام با موفقیت ویرایش شد');
        return redirect(route('admin.Role.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(role $Role)
    {
        $Role->delete();
        alert()->success('مقام با موفقیت حذف شد');
        return back();
    }
}
