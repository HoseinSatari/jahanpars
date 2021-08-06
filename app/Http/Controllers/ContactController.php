<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function show()
    {
        $this->seo()->setTitle('تماس با ما')->setDescription('صفحه تماس با ما و پشتیبانی');
        return view('home.contact');
    }

    public function send(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'email' => ['required'],
            'phone' => ['required'],
            'site'  =>['nullable'],
            'text' => ['required'],
        ]);

        Contact::create($data);
        toastr()->success('سپاس بابت ارسال پیام ، همکاران ما بعد از مشاهده پیام پاسخگوی شما خواهند بود');
        return back();

    }
}
