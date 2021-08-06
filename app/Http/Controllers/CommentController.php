<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
         $data = $request->validate([
             'name' => 'required',
             'email' => ['required'],
             'comment' => ['required'],
             'commentable_type' =>['required'],
             'commentable_id' => ['required'],
         ]);
         auth()->check() ? $data['user_id']= auth()->user()->id : '';
         Comment::create($data);
         toastr()->success('نظر شما با موفقیت ثبت شد ، بعد از تایید منتشر میشود.');
         return back();
    }
}
