<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OffersResource extends JsonResource
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
            'offer_id'  =>$this->id,
            'from_date' =>$this->from,
            'to_date'   =>$this->to,
            'type'      =>$this->type,
            'gender'    =>$this->gender,
            'owner'     =>$this->user->full_name,
            'category'  =>$this->category->name_ar,    
            'note'      =>$this->note,
            
        ];
    }
}
