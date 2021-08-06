<?php

namespace App\Http\Controllers;

use App\Company;
use App\visit;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $this->seo()->setTitle('شرکت های طرف قرار')->setDescription('لیست شرکت های طرف قرار داد جهانپارس');
        return view('home.companys');
    }


    public function single(Company $id , Request $request)
    {
        if ($visit = $id->visit()->where('ip', $request->ip())->first()) {
            $visit->update(['qty' => $visit->qty + 1]);
        }else{
            $id->visit()->create([
                'visitable_type' => get_class($id),
                'visitable_id'   => $id->id,
                'ip'    => $request->ip(),
                'qty' => '1',
            ]);
        }
        $this->seo()->setTitle($id->title)->setDescription($id->short_descript);
        return view('home.single_company' , ['company' => $id]);
    }
}
