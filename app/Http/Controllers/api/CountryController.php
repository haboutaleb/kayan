<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\PARENT_API;
use App\Model\Country;
use App\Http\Resources\CountryCollection;

class CountryController extends PARENT_API
{
    public function all(){
        $countries=Country::all();
            $this->data['data'] = new CountryCollection($countries);
            $this->data['status'] = "ok";
            $this->data['message'] = trans('api.request-done');
            return response()->json($this->data, 405);
    }

     public function getAllCities(Type $var = null)
     {
        $cities = City::all();
        if(!$cities){
            return response()->json(['message'=>trans('api.no-cities-available'),'data'=>[],'status'=>false],503);
        }

        $citiesData = CityResource::collection($cities);

        return response()->json(['message'=>trans('api.request-done'),'date'=>$categoriesData,'status'=>true],200);

     }
}
