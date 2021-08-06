<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show_permission')->only(['index']);
        $this->middleware('can:create_permission')->only(['create' , 'store']);
        $this->middleware('can:update_permission')->only(['edit' , 'update']);
        $this->middleware('can:delete_permission')->only(['destroy']);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = permission::query();

        if ($keyword = \request()->search) {
            $permissions = $permissions->where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('label', 'LIKE', "%{$keyword}%");
        }
        $permissions = $permissions->latest()->paginate(20);
        $permissions->appends(\request()->query())->links();
        return view('panel.permission.all', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.permission.create');
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
            'name' => ['required'],
            'label' => ['required'],
        ]);

        permission::create($data);
        alert()->success('دسترسی با موفقیت ایجاد شد');
        return redirect(route('admin.permission.index'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\permission $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(permission $permission)
    {
        return view('panel.permission.edit' , compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\permission $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, permission $permission)
    {
        $data = $request->validate([
            'name' => ['required'],
            'label' => ['required'],
        ]);

        $permission->update($data);
        alert()->success('دسترسی با موفقیت ویرایش شد');
        return redirect(route('admin.permission.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\permission $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(permission $permission)
    {
        $permission->delete();
        alert()->success('دسترسی با موفقیت حذف شد');
        return back();
    }
}
