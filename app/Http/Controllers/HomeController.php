<?php

namespace App\Http\Controllers;

use App\visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->seo()->setTitle('صفحه اصلی')->setDescription(option()->description);
        return view('home.index');
    }

    public function logout(Request $request)
    {
        if (auth()->check()):
            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect('/');
        endif;
    }

    public function about()
    {
        $this->seo()->setTitle('درباره ما')->setDescription('صفحه درباره ما جهانپارس');
        return view('home.about');
    }

    public function team()
    {
        return view('home.team');
    }

    public function bio()
    {
        return view('home.bio');
    }
}
