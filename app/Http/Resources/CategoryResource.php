<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'category_id'=>$this->id,
            'category_name'=> ($request->header('lang')== 'en') ? $this->name_en :$this->name_ar,
            'category_image'  =>$this->imageurl,
            'description'  =>($request->header('lang') == 'en') ? $this->description_en :$this->description_ar,
        ];
    }
}
