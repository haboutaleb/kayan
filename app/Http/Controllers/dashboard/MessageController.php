<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\PARENT_DASHBOARD;
use App\Model\Message;
use App\User;
use App\Http\Requests\dashboard\CreateMessageRequest;
use App\Http\Requests\dashboard\EditMessageRequest;
use App\Http\Controllers\Controller;

class MessageController extends PARENT_DASHBOARD
{
    //

    public function __construct()
    {
        $this->data['squence_pages'][trans('dash.message')] = route('message');
        $this->mainRedirect = 'dashboard.messages.';
    }

    public function index()
    {
        $this->data['messages'] = Message::all();
        return view($this->mainRedirect . 'index', $this->data);
    }

    public function create()
    {
        $this->data['squence_pages'][trans('dash.add_new_message')] = route('message_create');
        $this->data['latest_messages'] = Message::latest()->take(10)->get();
        $this->data['users'] = User::where('type','organization')->orwhere('type','user')->get();
        return view($this->mainRedirect . 'create', $this->data);
    }

    public function store(CreateMessageRequest $request)
    {
        $message              = new Message();
        $message->message     = $request->message;
        $message->from_user   = $request->from_id;
        $message->to_user     = $request->to_id  ;
        if($request->status){
        $message->status      = $request->status ;
        }
        $message->save();

        if ($request->back) {
            $forward_url = url('dashboard/message/create');
        } else {
            $forward_url = url('dashboard/message');
        }
        return redirect($forward_url)->with('class', 'alert alert-success')->with('message', trans('dash.added_successfully'));
    }

    public function edit($id = 0)
    {
        if (!Message::find($id)) {
            return back()->with('class', 'alert alert-danger')->with('message', trans('dash.try_2_access_not_found_content'));
        }
        $this->data['message'] = Message::find($id);
        $this->data['users'] = User::where('type','organization')->orwhere('type','user')->get();
        $this->data['squence_pages'][trans('dash.edit_message')] = route('message_edit');
        $this->data['latest_message'] = Message::latest()->take(10)->get();
        return view($this->mainRedirect . 'edit', $this->data);
    }

    public function update(EditMessageRequest $request)
    {
        $message              = Message::find($request->message_id);
        $message->message     = $request->message;
        $message->from_user   = $request->from_id;
        $message->to_user     = $request->to_id  ;
        if($request->status){
        $message->status      = $request->status ;
        }
        $message->update();
        if ($request->back) {
            $forward_url = url('dashboard/message/edit') . '/' . $message->id;
        } else {
            $forward_url = url('dashboard/message');
        }
        return redirect($forward_url)->with('class', 'alert alert-success')->with('message', trans('dash.edited_successfully'));
    }


    public function delete($id = 0)
    {
        if (!$message = Message::find($id)) {
            return back()->with('class', 'alert alert-danger')->with('message', trans('dash.try_2_access_not_found_content'));
        }
        $message->delete();
        return back()->with('class', 'alert alert-success')->with('message', trans('dash.deleted_successfully'));
    }
}
