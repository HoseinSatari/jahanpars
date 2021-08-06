<?php

namespace App\Http\Controllers\Admin;

use App\Company;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show_company')->only(['index']);
        $this->middleware('can:create_company')->only(['create', 'store']);
        $this->middleware('can:edit_company')->only(['edit', 'update']);
        $this->middleware('can:delete_company')->only(['destroy']);


    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companys = Company::query();

        if ($keyword = \request()->search) {
            $companys = $companys->where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('short_text', 'LIKE', "%{$keyword}%")
                ->orWhere('text', 'LIKE', "%{$keyword}%")
                ->orWhereHas('user', function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', "%{$keyword}%");
                });
        }
        if (\request()->active) {
            $companys = $companys->where('is_active' , '1');
        }
        if (\request()->deactive) {
            $companys = $companys->where('is_active' , '0');
        }
        $companys = $companys->latest()->paginate(10);
        $companys->appends(\request()->query())->links();
        return view('panel.company.index', compact('companys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.company.create');
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
            'title' => ['required'],
            'short_text' => ['required'],
            'text' => ['required'],
            'image' => ['required'],
            'keyword' => ['nullable'],
        ]);
        $comany = auth()->user()->company()->create($data);

        $request->deactive ? $comany->update(['is_active' => '0']) : '';
        toastr()->success('شرکت با موفقیت افزوده شد');
        return redirect(route('admin.companys.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('panel.company.edit' , compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {

        $data = $request->validate([
            'title' =>['required'],
            'short_text' => ['required'],
            'text' => ['required'],
            'image' => ['required'],
            'keyword' =>['nullable'],
        ]);
        $request->has('deactive') ? $company->update(['is_active' , '0'])  : $company->update(['is_active' , '1']);

        $company->update($data);

        toastr()->success('شرکت با موفقیت ویرایش شد');
        return redirect(route('admin.companys.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();
        toastr()->success('با موفقیت حذف شد');
        return back();
    }
}
