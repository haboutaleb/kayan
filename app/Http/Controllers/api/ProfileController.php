<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\IMAGE_CONTROLLER;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PARENT_API;
use App\User;
use App\Model\Review;
use App\Model\Token;
use App\Http\Resources\SingleUser;
use App\Http\Requests\api\UpdateProfileRequest;
use App\Http\Requests\api\UpdatePasswordRequest;
use App\Http\Requests\api\SetReviewRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\api\FilterRequest;
use App\Http\Requests\api\SetLocationRequest;
use App\Http\Requests\api\SetNewPasswordRequest;
use App\Http\Requests\api\GetUserDataByIdRequest;
use App\Http\Resources\ProvidersResource;

class ProfileController extends PARENT_API
{
    //

    public function profile()
    {
        $user = auth()->user();
        $this->data['data'] = new SingleUser($user);
        $this->data['status'] = "ok";
        $this->data['message'] = '';
        return response()->json($this->data, 200);
    }

     public function updateProfile(Request $request)
     {

        $user         = auth()->user()   ;
        if(!$user){
            $this->data['data'] = '';
            $this->data['status'] = "fails";
            $this->data['message'] = trans('api.can-not-find-this-profile');
            return response()->json($this->data, 405);
        }else{
            if ($request->name) {
                $user->full_name    = $request->name   ;
            }
            if ($request->email) {
               $email_count =  User::where('email',$request->email)->count();
               if ($email_count > 0) {
                    $this->data['data'] = '';
                    $this->data['status'] = "fails";
                    $this->data['message'] = trans('api.email-already-exists');
                    return response()->json($this->data, 405);
               }else{
                $user->email   = $request->email  ;
               }

            }
            if ($request->phone){
                $email_count =  User::where('mobile',$request->phone)->count();
               if ($email_count > 0) {
                    $this->data['data'] = '';
                    $this->data['status'] = "fails";
                    $this->data['message'] = trans('api.phone-already-exists');
                    return response()->json($this->data, 405);
               }else{
                $user->mobile   = $request->phone  ;
               }
                $user->mobile  = $request->phone  ;
            }
            if ($request->address){
                $user->address = $request->address;
            }
            if ($request->image) {
                $user->image = IMAGE_CONTROLLER::upload_single($request->image, 'storage/app/user');
            }

            if ($request->linked_in) {
                $user->linked_in = $request->linked_in;
            }

            if($request->bref){
                $user->bref = $request->bref;
            }

            $user->save();

        }

        $this->data['data'] = new SingleUser($user);
        $this->data['status'] = "ok";
        $this->data['message'] = trans('api.profile-updated');
        return response()->json($this->data, 200);

     }

     public function changePassword(UpdatePasswordRequest $request)
     {
        $user = auth()->user();
        $old_password = $request->old_password;

        $user_password= $user->password       ;

        if(!Hash::check($old_password, $user_password)){
            $this->data['data'] = [];
            $this->data['status'] = "fails";
            $this->data['message'] = trans('api.not-match-old-password');
            return response()->json($this->data, 405);
        }else{
            $user->password = bcrypt($request->password);
            $user->save();
            $this->data['data']    = '';
            $this->data['status']  = "ok";
            $this->data['message'] = trans('api.password-updated');
            return response()->json($this->data, 200);
        }

     }

     public function newPassword(SetNewPasswordRequest $request)
     {
        $user = auth()->user();

            $user->password = bcrypt($request->password);
        if(!$user->save()){
            $this->data['data']    = [];
            $this->data['status']  = "fail";
            $this->data['message'] = trans('api.try-again-later');
        } else{
            $this->data['data']    = '';
            $this->data['status']  = "ok";
            $this->data['message'] = trans('api.password-updated');
        }
            return response()->json($this->data, 200);

     }

     public function filterUser(FilterRequest $request)
     {
         $type = $request->filter_type;
         if($type=='new'){
            $users = User::where('type','organization')->order('id','desc')->get();
         }elseif ($type=='nearest') {

            $current_user = auth()->user();
            $user_id      = $current_user->id;
            $latitude     = $current_user->latitude;
            $longitude    = $current_user->longitude;
            $distance = 10;

            $userNearestList = User::where([
                ['latitude',  '!=', $latitude],
                ['longitude', '!=', $longitude]
            ])->whereRaw( DB::raw( "(3959 * acos( cos( radians($latitude) ) * cos( radians( latitude ) )  *
                 cos( radians( longitude ) - radians($longitude) ) + sin( radians($latitude) ) * sin(
                 radians( latitude ) ) ) ) < $distance ")
            )->take(10)->get();


         }elseif ($type=='reviews') {
             $users = User::where('type','organization')->orderBy('review')->get();
         }else {
            $this->data['data'] = [];
            $this->data['status'] = "fails";
            $this->data['message'] = trans('api.not-match-any-filter-type');
            return response()->json($this->data, 405);
         }


         $this->data['data'] = $users;
         $this->data['status'] = "ok";
         $this->data['message'] = trans('api.request-done');
         return response()->json($this->data, 200);
     }

     public function setReview(SetReviewRequest $request)
     {
        $authUser = auth()->user();

        $user_id = $request->user_id;
        $review  = $request->review;
        $user    = User::find($user_id);
        if(!$user){
            $this->data['data'] = [];
            $this->data['status'] = "fails";
            $this->data['message'] = trans('api.can-not-find-user');
            return response()->json($this->data, 405);
        }

        $reviewCount = Review::where('reviewer_id',$authUser->id)->where('user_id',$user_id)->count();
        if($reviewCount > 0){
            $this->data['data'] = [];
            $this->data['status'] = "fails";
            $this->data['message'] = trans('api.you-review-before');
            return response()->json($this->data, 405);
        }


        $newReview = new Review();
        $newReview->user_id = $user_id;
        $newReview->review  = $review;
        $newReview->reviewer_id= $authUser->id;
        $newReview->save();

        $userReviews = Review::where('user_id',$user_id)->get();

        if(count($userReviews)==0){
            $user->total_review = $review;
        }else{
            $reviewSum   = 0 ;
            $reviewCount = 0 ;
            foreach ($userReviews as  $review) {
                $reviewSum += $review->review;
                $reviewCount  ++;
            }
            $reviewAverage = $reviewSum/$reviewCount;
            $user->total_review = $reviewAverage;
        }


        if(!$user->save()){
            $this->data['data'] = [];
            $this->data['status'] = "fails";
            $this->data['message'] = trans('api.can-not-set-review');
            return response()->json($this->data, 405);
        }

        $this->data['data']    = '';
        $this->data['status']  = "ok";
        $this->data['message'] = trans('api.review-done');
        return response()->json($this->data, 200);
     }

     public function setLocation(SetLocationRequest $request)
     {

        $user = auth()->user();
        $user->latitude =$request->lat ;
        $user->longitude=$request->long;
        $user->address  =$request->address;

        if(!$user->save()){
            $this->data['data'] = [];
            $this->data['status'] = "fails";
            $this->data['message'] = trans('api.can-not-set-location');
            return response()->json($this->data, 405);
        }

        $this->data['data']    = '';
        $this->data['status']  = "ok";
        $this->data['message'] = trans('api.set-location-done');
        return response()->json($this->data, 200);

     }

     public function getUserById(GetUserDataByIdRequest $request)
     {
         $user = User::where('id',$request->user_id)->where('type','organization')->first();

         if(!$user){
            $this->data['data'] = [];
            $this->data['status'] = "fails";
            $this->data['message'] = trans('api.no-user-by-id');
            return response()->json($this->data, 405);
         }else{
            $this->data['data']    = new ProvidersResource($user);;
            $this->data['status']  = "ok";
            $this->data['message'] = trans('api.no-user-by-id');
            return response()->json($this->data, 200);
         }
     }
}
