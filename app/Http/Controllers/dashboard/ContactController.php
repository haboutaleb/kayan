<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\PARENT_DASHBOARD;
use App\Model\Contact;
use App\User;
use App\Http\Requests\dashboard\CreateContactRequest;
use App\Http\Requests\dashboard\EditContactRequest;
use App\Http\Controllers\Controller;

class ContactController extends PARENT_DASHBOARD
{
    //
    public function __construct()
    {
        $this->data['squence_pages'][trans('dash.contact')] = route('contact');
        $this->mainRedirect = 'dashboard.contacts.';
    }

    public function index()
    {
        $this->data['contacts'] = Contact::all();
        return view($this->mainRedirect . 'index', $this->data);
    }

    public function create()
    {
        $this->data['squence_pages'][trans('dash.add_new_contact')] = route('contact_create');
        $this->data['latest_contacts'] = Contact::latest()->take(10)->get();
        $this->data['users'] = User::where('type','organization')->orwhere('type','user')->get();
        return view($this->mainRedirect . 'create', $this->data);
    }

    public function store(CreateContactRequest $request)
    {
        $contact              = new Contact();
        $contact->subject     = $request->subject;
        $contact->message     = $request->message;
        $contact->user_id     = $request->user_id  ;
        if($request->status){
           $contact->status      = $request->status ;
        }
        $contact->save();

        if ($request->back) {
            $forward_url = url('dashboard/contact/create');
        } else {
            $forward_url = url('dashboard/contact');
        }
        return redirect($forward_url)->with('class', 'alert alert-success')->with('message', trans('dash.added_successfully'));
    }

    public function edit($id = 0)
    {
        if (!Contact::find($id)) {
            return back()->with('class', 'alert alert-danger')->with('message', trans('dash.try_2_access_not_found_content'));
        }
        $this->data['contact'] = Contact::find($id);
        $this->data['users'] = User::where('type','organization')->orwhere('type','user')->get();
        $this->data['squence_pages'][trans('dash.edit_contact')] = route('contact_edit');
        $this->data['latest_contacts'] = Contact::latest()->take(10)->get();
        return view($this->mainRedirect . 'edit', $this->data);
    }

    public function update(EditContactRequest $request)
    {
        $contact = Contact::find($request->contact_id);
        $contact->subject     = $request->subject;
        $contact->message     = $request->message;
        $contact->user_id     = $request->user_id  ;
        if($request->status){
           $contact->status      = $request->status ;
        }
        $contact->update();
        if ($request->back) {
            $forward_url = url('dashboard/contact/edit') . '/' . $contact->id;
        } else {
            $forward_url = url('dashboard/contact');
        }
        return redirect($forward_url)->with('class', 'alert alert-success')->with('message', trans('dash.edited_successfully'));
    }


    public function delete($id = 0)
    {
        if (!$contact = Contact::find($id)) {
            return back()->with('class', 'alert alert-danger')->with('message', trans('dash.try_2_access_not_found_content'));
        }
        $contact->delete();
        return back()->with('class', 'alert alert-success')->with('message', trans('dash.deleted_successfully'));
    }

}
