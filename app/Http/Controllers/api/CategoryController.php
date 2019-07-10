<?php

namespace App\Http\Controllers\api;
use App\Model\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\PARENT_API;
use App\Http\Resources\CategoryResource;
use App\User;
use App\Http\Requests\api\GetProvidersByCategoryIdRequest;
use App\Http\Resources\ProvidersResource;
class CategoryController extends PARENT_API
{
    //

    public function getAllCategories(Request $request)
    {
        $categories = Category::all();
        if(!$categories){
            return response()->json(['message'=>trans('api.no-categories-avaliable'),'data'=>[],'status'=>false],503);
        }

        $categoriesData = CategoryResource::collection($categories);

        return response()->json(['message'=>trans('api.request-done'),'date'=>$categoriesData,'status'=>true],200);

    }

    public function getCategoryById(Request $request)
    {
        $category = Category::find($request->id);

        if(!$category){
            return response()->json(['message'=>trans('api.no-data-avaliable-by-id'),'data'=>[],'status'=>false],503);
        }

        $categoryData = CategoryResource::collection($category);

        return response()->json(['message'=>trans('api.request-done'),'date'=>$categoryData,'status'=>true],200);

    }

    public function getServiceProviders(GetProvidersByCategoryIdRequest $request)
    {
          $request->category_id;

          $providers = User::where('category_id',$request->category_id)->where('type','organization')->get();

          if(count($providers)>0){
            $this->data['data'] =  ProvidersResource::collection($providers);
            $this->data['status'] = "ok";
            $this->data['message'] = trans('api.data-get-success');
            return response()->json($this->data, 200);
          }else{
            $this->data['data'] = [];
            $this->data['status'] = "fails";
            $this->data['message'] = trans('api.no-providers-exists-in-category');
            return response()->json($this->data, 405);
          }


    }
}
