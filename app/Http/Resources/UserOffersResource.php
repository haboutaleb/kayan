<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserOffersResource extends JsonResource
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
            'offer_id'        =>$this->id,
            'owner'           =>$this->user->full_name,
            'service_provider'=>(count($this->userOffer) > 0 ) ? ($this->userOffer->provider != null  ||'') ? $this->userOffer->provider->full_name :'' :'',
            'price'           =>(count($this->userOffer) > 0 ) ? ($this->userOffer->price    != null  ||'') ? $this->userOffer->price               :'' :'' ,
            'status'          =>(count($this->userOffer) > 0 ) ? ($this->userOffer->status   != null  ||'') ? $this->userOffer->status              :'' :'' ,
            'details'         =>(count($this->userOffer) > 0 ) ? ($this->userOffer->details  != null  ||'') ? $this->userOffer->details             :'' :'' ,
            'from'            =>$this->from,
            'to'              =>$this->to,
            'category'        =>($this->category != null || '') ? $this->category->name_ar:'',
        ];
    }
}
