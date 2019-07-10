<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SingleUser;
use App\Http\Controllers\PARENT_API;
use App\User;
use App\Model\Message;
use App\Model\Contact;
use App\Http\Resources\AllMessagesResource;
use App\Http\Resources\UserMessagesResource;
use App\Http\Requests\api\GetAllMessagesRequest;
use App\Http\Requests\api\SendMessageRequest;
use App\Http\Requests\api\SendContactRequest;


class ContactController extends PARENT_API
{
    //
    public function getMessagesList()
    {
        $user = auth()->user();

        $messagesList = Message::where('from_user',$user->id)->get();

        if(count($messagesList) ==0){
            $this->data['data'] = '';
            $this->data['status'] = "fails";
            $this->data['message'] = '';
            return response()->json($this->data, 405);
        }

        $this->data['data'] =  AllMessagesResource::collection($messagesList);
        $this->data['status'] = "ok";
        $this->data['message'] = '';
        return response()->json($this->data, 200);
    }

    public function sendMessage(SendMessageRequest $request)
    {
       $user   = auth()->user();

       $to_id  = $request->to_id;
       $message= $request->message;

       $newMessage = new Message();

       $newMessage->message   = $message;
       $newMessage->from_user = $user->id;
       $newMessage->to_user   = $to_id;
       $newMessage->save();

       $allMessages = Message::where('from_user',$user->id)->where('to_user',$to_id)->get();

        if (count($allMessages) ==0 ) {
            $this->data['data'] = '';
            $this->data['status'] = "fails";
            $this->data['message'] = '';
            return response()->json($this->data, 405);
        }

        $this->data['data'] = AllMessagesResource::collection($allMessages) ;
        $this->data['status'] = "ok";
        $this->data['message'] = '';
        return response()->json($this->data, 200);

    }

    public function sendContact(SendContactRequest $request)
    {
        $user   = auth()->user();
        $contact = New Contact();
        $contact->user_id = $user->id;
        $contact->subject = $request->subject;
        $contact->message = $request->message;

        if(!$contact->save()){
            $this->data['data'] = '';
            $this->data['status'] = "fails";
            $this->data['message'] = '';
            return response()->json($this->data, 405);
        }

        $this->data['data'] = '' ;
        $this->data['status'] = "ok";
        $this->data['message'] = 'contact sent successfully';
        return response()->json($this->data, 200);
    }

    public function getMessagesByUserId(GetAllMessagesRequest $request)
    {
        $user   = auth()->user();
        $to_id  = $request->user_id;
        $allMessages = Message::where('from_user',$user->id)->where('to_user',$to_id)->get();
        if (count($allMessages) == 0) {
            $this->data['data'] = '';
            $this->data['status'] = "fails";
            $this->data['message'] = '';
            return response()->json($this->data, 405);
        }

        $this->data['data'] = $allMessages ;
        $this->data['status'] = "ok";
        $this->data['message'] = '';
        return response()->json($this->data, 200);

    }
}
