<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SingleUser extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $name='name_'.app()->getLocale();

        return [
            'id'       =>$this->id,
            'full_name'=>$this->full_name,
            'email'    =>$this->email,
            'mobile'   =>($this->mobile       != null ||'') ? $this->mobile        :'' ,
            'image'    =>($this->Imageurl     != null ||'') ? $this->Imageurl      :'' ,
            'address'  =>($this->address      != null ||'') ? $this->address       :'' ,
            'linked_in'=>($this->linked_in    != null ||'') ? $this->linked_in     :'' ,
            'bref'     =>($this->bref         != null ||'') ? $this->bref          :'' ,
            'reviews'  =>($this->total_review != null ||'') ? $this->total_review  :'' ,
            'jwt'      =>$this->token->jwt,
            'type'     =>$this->type,
            
        ];
    }
}
