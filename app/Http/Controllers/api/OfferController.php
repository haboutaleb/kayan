<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PARENT_API;
use App\User;
use App\Model\Offer;
use App\Model\UserOffer;
use App\Http\Requests\api\CancelOfferRequest;
use App\Http\Requests\api\EditUserOffersRequest;
use App\Http\Requests\api\SetUserOfferRequest;
use App\Http\Requests\api\CreateNewOfferRequest;

use App\Http\Resources\OffersResource;
use App\Http\Resources\SingleOfferResource;
use App\Http\Resources\UserOffersResource;
use App\Http\Resources\OfferLocationResource;
use App\Http\Resources\UserResrvationsResource;
use App\Http\Resources\UserReservationsResource;

use App\Http\Requests\api\GetUserOfferRequest;
use App\Http\Requests\api\DeleteOfferRequest;
use App\Http\Requests\api\CreateReserveRequest;
use App\Http\Requests\api\CancelUserOffertRequest;
use App\Http\Requests\api\UpdateOfferRequest;
class OfferController extends PARENT_API
{
    public function getAllOffers()
    {
       $authUser = auth()->user();
       if($authUser->type =='organization'){
          $offers = Offer::where('category_id',$authUser->category_id)->where('gender',$authUser->gender)->get();
       }else{
         $offers = Offer::where('user_id',$authUser->id)->get();
       }




       if (count($offers)== 0) {
            $this->data['data'] = [];
            $this->data['status'] = "fails";
            $this->data['message'] = trans('api.no-offers-available');
            return response()->json($this->data, 405);
       }

       $this->data['data'] =  OffersResource::collection($offers);
       $this->data['status'] = "ok";
       $this->data['message'] = trans('api.request-done');
       return response()->json($this->data, 200);
    }

    public function getOfferById(GetUserOfferRequest $request)
    {
        $id= $request->offer_id;
        $offer = Offer::find($id);

        if (!$offer) {
             $this->data['data'] = [];
             $this->data['status'] = "fails";
             $this->data['message'] = trans('api.no-offers-available');
             return response()->json($this->data, 405);
        }

        $this->data['data'] =  new OffersResource($offer);
        $this->data['status'] = "ok";
        $this->data['message'] = trans('api.all-offers');
        return response()->json($this->data, 200);
    }

    public function getOffersByCategoryId(GetOffersByCategoryIdRequest $request)
    {

        $category_id= $request->category_id;
        $offers = Offer::where('category_id',$category_id)->get();

        if (!$offers) {
             $this->data['data'] = [];
             $this->data['status'] = "fails";
             $this->data['message'] = trans('api.no-offers-for-this-category');
             return response()->json($this->data, 405);
        }

        $this->data['data'] = OffersResource::collection($offers);
        $this->data['status'] = "ok";
        $this->data['message'] = trans('api.offers-for-this-category');
        return response()->json($this->data, 200);

    }


    public function createNewOffer(CreateNewOfferRequest $request)
    {
        $user_id = auth()->user()->id;

        $offer = New Offer();
        $offer->category_id = $request->category_id;
        $offer->type        = $request->type     ;
        $offer->from        = $request->from_date;
        $offer->to          = $request->to_date  ;
        $offer->gender      = $request->gender   ;
        $offer->note        = $request->note     ;
        $offer->user_id     = $user_id           ;

        if(!$offer->save()){
            $this->data['data'] = [];
            $this->data['status'] = "fails";
            $this->data['message'] = trans('api.can-not-create-offer');
            return response()->json($this->data, 405);
        }

        $this->data['data'] = '';
        $this->data['status'] = "ok";
        $this->data['message'] = trans('api.offer-created');
        return response()->json($this->data, 200);

    }



    public function updateOffer(EditUserOffersRequest $request)
    {
        $user_id = auth()->user()->id;
        $offer_id = $request->offer_id;
        $offer =  Offer::find($offer_id);

        if(!$offer){
            $this->data['data'] = [];
            $this->data['status'] = "fails";
            $this->data['message'] = trans('api.no-offer-this-id');
            return response()->json($this->data, 405);
        }

        $offer->category_id = $request->category_id;
        $offer->type        = $request->type     ;
        $offer->from        = $request->from_date;
        $offer->to          = $request->to_date  ;
        $offer->gender      = $request->gender   ;
        $offer->note        = $request->note     ;
        $offer->user_id     = $user_id           ;
        $offer->save();

        if(!$offer->save()){
            $this->data['data'] = '';
            $this->data['status'] = "fails";
            $this->data['message'] = trans('api.can-not-update-offer');
            return response()->json($this->data, 405);
        }

        $this->data['data'] = '';
        $this->data['status'] = "ok";
        $this->data['message'] = trans('api.offer-updated');
        return response()->json($this->data, 200);
    }

    public function deleteOffer(DeleteOfferRequest $request)
    {
        $user = auth()->user();
        $offer_id = $request->offer_id;

        $offer = Offer::find($offer_id);
        if(!$offer){
            $this->data['data'] = [];
            $this->data['status'] = "fails";
            $this->data['message'] = trans('api.no-offer-this-id');
            return response()->json($this->data, 405);
        }

        $offer->delete();

        $userOffers = UserOffer::where('offer_id',$offer_id)->get();
        if(count($userOffers) ==0){
            $this->data['data'] = '';
            $this->data['status'] = "ok";
            $this->data['message'] = trans('api.offer-deleted');
            return response()->json($this->data, 200);
        }

        foreach ($userOffers as $userOffer) {
              $userOffer->delete();
        }

        $this->data['data']    = '';
        $this->data['status']  = "ok";
        $this->data['message'] = trans('api.offer-deleted');
        return response()->json($this->data, 200);
    }

    public function getUserOffersByOfferID(GetUserOfferRequest $request)
    {
        $id= $request->offer_id;
        $offer = Offer::find($id);

        if(!$offer){
            $this->data['data'] = [];
            $this->data['status'] = "fails";
            $this->data['message'] = trans('api.no-offer-this-id');
        }

        $this->data['data'] =   new UserOffersResource($offer);
        $this->data['status'] = "ok";
        $this->data['message'] = trans('api.request-done');
        return response()->json($this->data, 200);

    }

    public function getAllMyOffers()
    {
        $user =  auth()->user();
        $offers = Offer::where('user_id',$user->id)->get();

        if(count($offers)== 0){
            $this->data['data'] = [];
            $this->data['status'] = "fails";
            $this->data['message'] =  trans('api.no-offer-for-you');
        }

        $this->data['data'] =   OffersResource::Collection($offers);
        $this->data['status'] = "ok";
        $this->data['message'] = trans('api.reuest-done');
        return response()->json($this->data, 200);

    }


    public function OfferLocation(GetUserOfferRequest $request)
    {
        $id    = $request->offer_id;
        $offer = Offer::find($id)  ;

        if(!$offer){
            $this->data['data'] = [];
            $this->data['status'] = "fails";
            $this->data['message'] = trans('api.no-offer-this-id');
        }

        $this->data['data'] =  new OfferLocationResource($offer);
        $this->data['status'] = "ok";
        $this->data['message'] = '';
        return response()->json($this->data, 200);
    }


    public function createUserOffer(SetUserOfferRequest $request)
    {

       $offer_id          = $request->offer_id    ;
       $user              = auth()->user()        ;

       $allThisUserOffersCount = UserOffer::where('from_user',$user->id)->count();

       if($user->package =='one' && $allThisUserOffersCount ==1){

        $this->data['data'] = [];
        $this->data['status'] = "fails";
        $this->data['message'] = trans('api.check-your-package');
        return response()->json($this->data, 405);

        }elseif($user->package =='five' && $allThisUserOffersCount ==1){
            $this->data['data'] = [];
            $this->data['status'] = "fails";
            $this->data['message'] = trans('api.check-your-package');
            return response()->json($this->data, 405);
        }elseif($user->package =='ten' && $allThisUserOffersCount ==1){
            $this->data['data'] = [];
            $this->data['status'] = "fails";
            $this->data['message'] = trans('api.check-your-package');
            return response()->json($this->data, 405);
        }else{
        $userOffersCount = UserOffer::where('offer_id',$offer_id)->where('from_user',$user->id)->count();

        if($userOffersCount != 0){
         $this->data['data'] = [];
         $this->data['status'] = "fails";
         $this->data['message'] = trans('api.you-set-offer-before-to-this-order');
         return response()->json($this->data, 405);
        }

         $offer             = Offer::find($offer_id);
         if(!$offer){
            $this->data['data'] = [];
            $this->data['status'] = "fails";
            $this->data['message'] = trans('api.no-offer-this-id');
            return response()->json($this->data, 405);
        }
         $newUser           = new UserOffer()       ;
         $newUser->price    = $request->price       ;
         $newUser->details  = $request->details     ;
         $newUser->offer_id = $offer_id             ;
         $newUser->from_user= $user->id             ;
         $newUser->to_user  = $offer->user_id       ;
         if(!$newUser->save()){
             $this->data['data'] = [];
             $this->data['status'] = "fails";
             $this->data['message'] = trans('api.can-not-create-user-offer');
             return response()->json($this->data, 405);
         }

         $this->data['data'] = '';
         $this->data['status'] = "ok";
         $this->data['message'] = trans('api.user-offer-created');
         return response()->json($this->data, 200);
       }


    }

    public function acceptUserOffer(GetUserOfferRequest $request)
    {
        $user = auth()->user();
        $offer_id = $request->offer_id;

        if($user->type == 'organization'){

            $userOffersCount = UserOffer::where('status','confirmed')->orWhere('status','pending')->where('to_user',$user->id)->orWhere('from_user',$user->id)->count();


            if ($userOffersCount ==0  ){
                $this->data['data'] = [];
                $this->data['status'] = "fails";
                $this->data['message'] = trans('api.can-not-find-user-offer');
                return response()->json($this->data, 405);
            }
            if( $user->package =='one' && $userOffersCount ==1){
                $this->data['data'] = [];
                $this->data['status'] = "fails";
                $this->data['message'] = trans('api.you-can-not-set-offer-check-your-package');
                return response()->json($this->data, 405);
            }elseif ($user->package =='five' && $userOffersCount ==5){
                $this->data['data'] = '';
                $this->data['status'] = "fails";
                $this->data['message'] = trans('api.you-can-not-set-offer-check-your-package');
                return response()->json($this->data, 405);
            }elseif ($user->package =='ten' && $userOffersCount ==10) {
                $this->data['data'] = [];
                $this->data['status'] = "fails";
                $this->data['message'] = trans('api.you-can-not-set-offer-check-your-package');
                return response()->json($this->data, 405);
            }else{

                $userOffer = UserOffer::where('to_user',$user->id)->where('offer_id',$offer_id)->first();
                $userOffer->status = 'confirmed';
                if(!$userOffer->save()){
                    $this->data['data'] = [];
                    $this->data['status'] = "fails";
                    $this->data['message'] = trans('api.can-not-create-user-offer');
                    return response()->json($this->data, 405);
                }

                $this->data['data'] = '';
                $this->data['status'] = "ok";
                $this->data['message'] = trans('api.user-offer-confirmed');
                return response()->json($this->data, 200);
            }


        }else{
            $userOffer = UserOffer::where('offer_id',$offer_id)->where('to_user',$user->id)->first();
            if(!$userOffer){
                $this->data['data'] = [];
                $this->data['status'] = "fails";
                $this->data['message'] = trans('api.can-not-find-user-offer');
                return response()->json($this->data, 405);
            }

            $userOffer->status = 'confirmed';

            if(!$userOffer->save()){
                $this->data['data'] = [];
                $this->data['status'] = "fails";
                $this->data['message'] = trans('api.can-not-create-user-offer');
                return response()->json($this->data, 405);
            }

            $this->data['data'] = '';
            $this->data['status'] = "ok";
            $this->data['message'] =  trans('api.user-offer-confirmed');
            return response()->json($this->data, 200);
        }



    }


    public function editUserOffer(UpdateOfferRequest $request)
    {
        $offer_id          = $request->offer_id    ;
        $user              = auth()->user()        ;

        $updatedOffer      = UserOffer::find($offer_id);
        $offer             = Offer::find($updatedOffer->offer_id);

        if(!$updatedOffer){
            $this->data['data'] = [];
            $this->data['status'] = "fails";
            $this->data['message'] = trans('api.can-not-find-user-offer');
            return response()->json($this->data, 405);
        }

        $updatedOffer->price    = $request->price       ;
        $updatedOffer->details  = $request->details     ;
        $updatedOffer->offer_id = $offer_id             ;
        $updatedOffer->from_user= $user->id             ;
        $updatedOffer->to_user  = $offer->user_id       ;

        if(!$updatedOffer->save()){
            $this->data['data'] = [];
            $this->data['status'] = "fails";
            $this->data['message'] = trans('api.can-not-update-user-offer');
            return response()->json($this->data, 405);
        }

        $this->data['data'] = '';
        $this->data['status'] = "ok";
        $this->data['message'] = trans('api.user-offer-updated');
        return response()->json($this->data, 200);
    }

    public function cancelUserOffer(CancelUserOffertRequest $request)
    {
        $user = auth()->user();
        $offer_id = $request->offer_id;

        $userOffer = UserOffer::find($offer_id);
        if(!$userOffer){
            $this->data['data'] = [];
            $this->data['status'] = "fails";
            $this->data['message'] = trans('api.can-not-find-user-offer');
            return response()->json($this->data, 405);
        }

        $userOffer->status = 'cancelled';

        if(!$userOffer->save()){
            $this->data['data'] = [];
            $this->data['status'] = "fails";
            $this->data['message'] = trans('api.can-not-update-user-offer');
            return response()->json($this->data, 405);
        }

        $userOffer->status = 'cancelled';
        $userOffer->save();

        $this->data['data'] = '';
        $this->data['status'] = "ok";
        $this->data['message'] = trans('api.user-offer-cancelld');
        return response()->json($this->data, 200);
    }

    public function deleteUserOffer(CancelUserOffertRequest $request)
    {
        $user = auth()->user();
        $offer_id = $request->offer_id;

        $userOffer = UserOffer::find($offer_id);
        if(!$userOffer){
            $this->data['data'] = [];
            $this->data['status'] = "fails";
            $this->data['message'] = trans('api.can-not-find-user-offer');
            return response()->json($this->data, 405);
        }


        if(!$userOffer->delete()){
            $this->data['data'] = [];
            $this->data['status'] = "fails";
            $this->data['message'] = trans('api.can-not-delete-user-offer');
            return response()->json($this->data, 405);
        }

        $this->data['data'] = '';
        $this->data['status'] = "ok";
        $this->data['message'] = trans('api.user-offer-deleted');
        return response()->json($this->data, 200);
    }

    public function reserve(CreateReserveRequest $request)
    {
        $authUser = auth()->user();
        $user_id = $request->user_id;
        $user    = User::find($user_id);

        $offer = New Offer();

        $offer->type        = $request->type       ;
        $offer->from        = $request->from_date  ;
        $offer->to          = $request->to_date    ;
        $offer->note        = $request->note       ;
        $offer->gender      = $user->gender        ;
        $offer->category_id = $user->category_id   ;
        $offer->user_id     = $authUser->id        ;

        if(!$offer->save()){
            $this->data['data'] = '';
            $this->data['status'] = "fails";
            $this->data['message'] = trans('api.can-not-save-offer');
            return response()->json($this->data, 405);
        }

        $newUser           = new UserOffer()       ;
        $newUser->price    = $request->price       ;
        $newUser->details  = $request->details     ;
        $newUser->offer_id = $offer->id            ;
        $newUser->from_user= $authUser->id         ;
        $newUser->to_user  = $user_id              ;
        if(!$newUser->save()){
            $this->data['data'] = '';
            $this->data['status'] = "fails";
            $this->data['message'] = trans('api.can-not-create-user-offer');
            return response()->json($this->data, 405);
        }

        $this->data['data'] = '';
        $this->data['status'] = "ok";
        $this->data['message'] = trans('api.reservation-created');
        return response()->json($this->data, 200);


    }

    public function allReservations()
    {
        $authUser = auth()->user();
        if($authUser->type =='organization'){
           $offers = UserOffer::where('from_user',$authUser->id)->get();
        }else{
          $offers = UserOffer::where('from_user',$authUser->id)->get();
        }




        if (count($offers)== 0) {
             $this->data['data'] = [];
             $this->data['status'] = "fails";
             $this->data['message'] = trans('api.no-offers-available');
             return response()->json($this->data, 405);
        }

        $this->data['data'] =  UserReservationsResource::collection($offers);
        $this->data['status'] = "ok";
        $this->data['message'] = trans('api.request-done');
        return response()->json($this->data, 200);
    }

}
