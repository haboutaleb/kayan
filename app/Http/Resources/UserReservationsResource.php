<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserReservationsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
            'id'=>$this->id,
            'name'=>$this->provider->full_name,
            'provider_id'=>$this->provider->id,
            'user_image'=>$this->provider->Imageurl ,
            'address'=>$this->provider->address,
            'rate'=>($this->provider->total_review == '') ? '0' : $this->provider->total_review,
            'status'=>$this->status,
        ];


    }
}
