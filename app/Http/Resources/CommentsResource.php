<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentsResource extends JsonResource
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
            'comment_id'  =>$this->id,
            'user_profile'=>$this->profile->full_name,
            'user'        =>$this->user->full_name,
            'comment'     =>$this->comment 
        ];
    }
}
