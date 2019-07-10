<?php

namespace App\Http\Resources;

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
        'sender'=> $this->sender->full_name,
        'recvier'=>$this->reciver->full_name,
        'message'=>$this->message,

      ] ;
    }
}
