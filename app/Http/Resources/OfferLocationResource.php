<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OfferLocationResource extends JsonResource
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
            'your_lang' =>auth()->user()->longitude,
            'your_lat'  =>auth()->user()->latitude,
            'owner_lang'=>$this->user->longitude,
            'owner_lat' =>$this->user->latitude
        ];
    }
}
