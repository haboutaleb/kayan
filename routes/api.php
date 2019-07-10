<?php

use Illuminate\Http\Request;


//=============== for auth route========================
Route::any('signup', 'AuthController@signup');
Route::any('signup/orgnization', 'AuthController@orgnizationSinUp');
Route::any('signin', 'AuthController@signin');
Route::anY('categories','CategoryController@getAllCategories');

Route::group(['middleware' => ['jwt.auth']], function () {

    Route::any('user/logout'         ,'AuthController@logout'           );
    Route::any('user/profile'        ,'ProfileController@profile'       );
    Route::any('user/profile/update' ,'ProfileController@updateProfile' );
    Route::any('user/password/update','ProfileController@changePassword');
    Route::any('user/password/new'   ,'ProfileController@newPassword'   );
    Route::any('get/user/data'       ,'ProfileController@getUserById'   );

    Route::any('user/getuser/filter' ,'ProfileController@filterUser'    );
    Route::any('user/review'         ,'ProfileController@setReview'     );
    Route::any('user/set/location'   ,'ProfileController@setLocation'   );


    Route::any('send/contact'        ,'ContactController@sendContact'   );

    Route::any('send/message'        ,'ContactController@sendMessage'   );
    Route::any('get/messages'        ,'ContactController@getMessagesByUserId');
    Route::any('messages/list'       ,'ContactController@getMessagesList');

    Route::any('get/comments'        ,'ContactController@getCommentsByUserId');
    Route::any('comment/create'     ,'ContactController@createComment');
    Route::any('comment/edit'        ,'ContactController@editComment');


    Route::any('offers/all'          ,'OfferController@getAllOffers'     );
    Route::any('getoffer'            ,'OfferController@getOfferById'     );
    Route::any('getoffer/bycategory' ,'OfferController@getOffersByCategoryId');

    Route::any('category/get/providers'       ,'CategoryController@getServiceProviders' );
    Route::any('newoffer'            ,'OfferController@createNewOffer'         );
    Route::any('offer/update'        ,'OfferController@updateOffer'            );
    Route::any('offer/delete'        ,'OfferController@deleteOffer'            );
    Route::any('offer/location'      ,'OfferController@OfferLocation'          );
    Route::any('offer/users/offers'  ,'OfferController@getUserOffersByOfferID' );
    Route::any('user/offers'         ,'OfferController@getAllMyOffers'         );

    Route::any('get/reservation'     ,'OfferController@allReservations'  );
    Route::any('user/offer/create'   ,'OfferController@createUserOffer'  );
    Route::any('user/offer/accept'   ,'OfferController@acceptUserOffer'  );
    Route::any('user/offer/edit'     ,'OfferController@editUserOffer'    );
    Route::any('user/offer/cancel'   ,'OfferController@cancelUserOffer'  );
    Route::any('user/offer/delete'   ,'OfferController@deleteUserOffer'  );

    Route::any('user/create/reservation', 'OfferController@reserve');

    Route::any('notification/my_notifications', 'api\NotificationController@my_notifications');

});
