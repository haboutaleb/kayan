<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\PARENT_DASHBOARD;
use App\Model\Comment;
use App\User;
use App\Http\Requests\dashboard\CreateCommentRequest;
use App\Http\Requests\dashboard\EditCommentRequest;
use App\Http\Controllers\Controller;

class CommentController extends PARENT_DASHBOARD
{
    public function __construct()
    {
        $this->data['squence_pages'][trans('dash.comment')] = route('comment');
        $this->mainRedirect = 'dashboard.comments.';
    }

    public function index()
    {
        $this->data['comments'] = Comment::all();
        return view($this->mainRedirect . 'index', $this->data);
    }

    public function create()
    {
        $this->data['squence_pages'][trans('dash.add_new_comment')] = route('comment_create');
        $this->data['latest_comments'] = Comment::latest()->take(10)->get();
        $this->data['users'] = User::where('type','organization')->orwhere('type','user')->get();
        return view($this->mainRedirect . 'create', $this->data);
    }

    public function store(CreateCommentRequest $request)
    {
        $comment              = new Comment();
        $comment->from_user   = $request->from_id;
        $comment->user_id     = $request->to_id;
        $comment->comment     = $request->comment  ;
 
        $comment->save();

        if ($request->back) {
            $forward_url = url('dashboard/comment/create');
        } else {
            $forward_url = url('dashboard/comment');
        }
        return redirect($forward_url)->with('class', 'alert alert-success')->with('message', trans('dash.added_successfully'));
    }

    public function edit($id = 0)
    {
        if (!Comment::find($id)) {
            return back()->with('class', 'alert alert-danger')->with('message', trans('dash.try_2_access_not_found_content'));
        }
        $this->data['comment'] = Comment::find($id);
        $this->data['users'] = User::where('type','organization')->orwhere('type','user')->get();
        $this->data['squence_pages'][trans('dash.edit_comment')] = route('comment_edit');
        $this->data['latest_comments'] = Comment::latest()->take(10)->get();
        return view($this->mainRedirect . 'edit', $this->data);
    }

    public function update(EditMessageRequest $request)
    {
        $comment = Comment::find($request->comment_id);
        $comment->from_user   = $request->from_id;
        $comment->user_id     = $request->to_id;
        $comment->comment     = $request->comment  ;
 
        $comment->update();
        if ($request->back) {
            $forward_url = url('dashboard/comment/edit') . '/' . $comment->id;
        } else {
            $forward_url = url('dashboard/comment');
        }
        return redirect($forward_url)->with('class', 'alert alert-success')->with('message', trans('dash.edited_successfully'));
    }


    public function delete($id = 0)
    {
        if (!$comment = Comment::find($id)) {
            return back()->with('class', 'alert alert-danger')->with('message', trans('dash.try_2_access_not_found_content'));
        }
        $comment->delete();
        return back()->with('class', 'alert alert-success')->with('message', trans('dash.deleted_successfully'));
    }


}
