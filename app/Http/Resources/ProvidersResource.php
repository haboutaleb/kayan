<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProvidersResource extends JsonResource
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
            'name'=>$this->full_name,
            'user_image'=>$this->Imageurl,
            'reate'=>($this->total_review == '') ? '0' : $this->total_review,
            'address'=>$this->address,
            'desc'=>($this->desc ==null) ? '':$this->desc
        ];
    }
}
