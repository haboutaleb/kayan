<?php

namespace App\Http\Resources;
use App\Http\Controllers\IMAGE_CONTROLLER;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AllMessagesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {


      return [
        'message_id'=>    $this->id,
        'user_name'=> ($this->sender->id == auth()->user()->id) ? $this->recvier->full_name  : $this->sender->full_name ,
        'user_image'=> ($this->sender->id == auth()->user()->id) ?  $this->recvier->Imageurl : $this->sender->Imageurl,
        'message'=>$this->message,

      ] ;
    }
}
