<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SingleUser;
use App\Http\Controllers\PARENT_API;
use App\User;
use App\Model\Message;
use App\Model\Contact;
use App\Model\Comment;
use App\Http\Resources\AllMessagesResource;
use App\Http\Resources\UserMessagesResource;
use App\Http\Resources\CommentsResource;

use App\Http\Requests\api\GetAllMessagesRequest;
use App\Http\Requests\api\SendMessageRequest;
use App\Http\Requests\api\SendContactRequest;
use App\Http\Requests\api\CreateCommentRequest;
use App\Http\Requests\api\EditCommentRequest;

class ContactController extends PARENT_API
{
    //
    public function getMessagesList()
    {
        $user = auth()->user();

        $messagesList = Message::where('to_user',$user->id)->latest()->get();

        if(count($messagesList) ==0){
            $this->data['data'] = [];
            $this->data['status'] = "fails";
            $this->data['message'] = trans('api.no-messages-for-user');
            return response()->json($this->data, 405);
        }

        $this->data['data'] =  AllMessagesResource::collection($messagesList);
        $this->data['status'] = "ok";
        $this->data['message'] = trans('messages-for-user');
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
            $this->data['data'] = [];
            $this->data['status'] = "fails";
            $this->data['message'] = trans('api.no-messages-between-users');
            return response()->json($this->data, 405);
        }

        $this->data['data'] = AllMessagesResource::collection($allMessages) ;
        $this->data['status'] = "ok";
        $this->data['message'] = trans('api.messages-between-users');
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
            $this->data['data'] = [];
            $this->data['status'] = "fails";
            $this->data['message'] = trans('api.contact-can-not-sent');
            return response()->json($this->data, 405);
        }

        $this->data['data'] = '' ;
        $this->data['status'] = "ok";
        $this->data['message'] = trans('api.contact-sent');
        return response()->json($this->data, 200);
    }

    public function getMessagesByUserId(GetAllMessagesRequest $request)
    {
        $user   = auth()->user();
        $to_id  = $request->user_id;
        $allMessages = Message::where('from_user',$user->id)->where('to_user',$to_id)->get();
        if (count($allMessages) == 0) {
            $this->data['data'] = [];
            $this->data['status'] = "fails";
            $this->data['message'] = trans('api.no-messages-for-this-user');
            return response()->json($this->data, 405);
        }

        $this->data['data'] = AllMessagesResource::collection($allMessages) ;
        $this->data['status'] = "ok";
        $this->data['message'] = trans('api.messages-between-users');
        return response()->json($this->data, 200);

    }

    public function createComment(CreateCommentRequest $request)
    {
       $user   = auth()->user();

       $to_id  = $request->to_id;
       $comment= $request->comment;

       $newComment = new Comment();

       $newComment->comment   = $comment;
       $newComment->from_user = $user->id;
       $newComment->user_id   = $to_id;
       $newComment->save();

        $this->data['data'] = '' ;
        $this->data['status'] = "ok";
        $this->data['message'] = trans('api.comment-published');
        return response()->json($this->data, 200);

    }

    public function editComment(CreateCommentRequest $request)
    {
       $user   = auth()->user();

       $to_id  = $request->to_id;
       $comment= $request->comment;
       $comment_id = $request->comment_id;
       $editedComment = Comment::find($comment_id);

       $editedComment->comment   = $comment;
       $editedComment->from_user = $user->id;
       $editedComment->user_id   = $to_id;
       $editedComment->save();

        $this->data['data'] = '' ;
        $this->data['status'] = "ok";
        $this->data['message'] = trans('api.comment-updated');
        return response()->json($this->data, 200);

    }



    public function getCommentsByUserId(GetAllMessagesRequest $request)
    {
        $user   = auth()->user();
        $user_id  = $request->user_id;
        $allComments = Comment::where('user_id',$user_id)->get();
        if (count($allComments) == 0) {
            $this->data['data'] = [];
            $this->data['status'] = "fails";
            $this->data['message'] = '';
            return response()->json($this->data, 405);
        }

        $this->data['data'] = CommentsResource::collection($allComments) ;
        $this->data['status'] = "ok";
        $this->data['message'] = trans('api.all-comments');
        return response()->json($this->data, 200);

    }

}
