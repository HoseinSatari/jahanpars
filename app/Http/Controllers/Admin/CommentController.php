<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:show_comment')->only(['index']);
        $this->middleware('can:update_comment')->only(['send', 'approve']);
        $this->middleware('can:delete_comment')->only(['destroy']);


    }
    public function index()
    {

        $comments = Comment::where('approved', 1);
        if (\request()->unapproved) {
            $comments = Comment::where('approved', 0);
        }

        if ($keyword = \request('search')) {
            $comments = $comments->where('name', 'LIKE', "%{$keyword}%")
                ->orWhere('email', 'LIKE', "%{$keyword}%")
                ->orWhere('comment', 'LIKE', "%{$keyword}%");
        }

        $comments = $comments->latest()->paginate('20');
        $comments->appends(\request()->query())->links();
        return view('panel.comment.index', compact('comments'));

    }

    public function send(Request $request)
    {

        $data = $request->validate([
            'parent_id' => 'required',
            'name' => ['required'],
            'comment' => ['required'],
        ]);
        $data['approved'] = 1;

        $data['email'] = auth()->user()->email ?? '';
        $parent = Comment::findorfail($data['parent_id']);
        $data['commentable_type'] = $parent->commentable_type;
        $data['commentable_id'] = $parent->commentable_id;
        auth()->user()->comments()->create($data);

        toastr()->success('با موفقیت ارسال شد.');
        return back();

    }

    public function approve(Comment $id)
    {

        $id->update(['approved' => 1]);
        toastr()->success('با موفقیت تایید شد.');
        return back();
    }

    public function delete(Comment $id)
    {
        $id->delete();
        toastr()->success('با موفقیت حذف شد.');
        return back();
    }
}
