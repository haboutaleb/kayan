<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'dashboard'], function () {

    Route::get('logout', 'dashboard\AuthController@logout')->name('dashboard_logout');
    Route::group(['middleware' => 'guest'], function () {
        Route::get('login', 'dashboard\AuthController@login')->name('dashboard_login');
        Route::post('login_post', 'dashboard\AuthController@login_post');
    });
    Route::group(['middleware' => 'admin'], function () {
        Route::get('/', 'dashboard\HomeController@index')->name('dashboard_home');

        Route::group(['prefix' => 'auth'], function () {
            Route::get('profile', 'dashboard\AuthController@profile')->name('admin_profile');
            Route::get('change_password', 'dashboard\AuthController@change_password')->name('change_password');
            Route::post('update', 'dashboard\AuthController@update')->name('update_profile');
            Route::post('update_password', 'dashboard\AuthController@update_password')->name('update_password');
            Route::get('logout', 'dashboard\AuthController@logout')->name('dashboard_logout');
        });

        Route::group(['prefix' => 'setting'], function () {
            Route::get('/', 'dashboard\SettingController@index')->name('setting')->middleware('perms:setting');
            Route::post('update', 'dashboard\SettingController@update')->name('setting_update')->middleware('perms:setting');
            Route::get('pages', 'dashboard\SettingController@pages')->name('setting_pages')->middleware('perms:setting');
        });

        Route::group(['prefix' => 'country'], function () {
            Route::get('/', 'dashboard\CountryController@index')->name('countries')->middleware('perms:countries');
            Route::get('create', 'dashboard\CountryController@create')->name('country_create')->middleware('perms:country_create');
            Route::post('store', 'dashboard\CountryController@store')->name('country_store')->middleware('perms:country_create');
            Route::get('edit/{id?}', 'dashboard\CountryController@edit')->name('country_edit')->middleware('perms:country_edit');
            Route::post('update', 'dashboard\CountryController@update')->name('country_update')->middleware('perms:country_edit');
            Route::get('delete/{id?}', 'dashboard\CountryController@delete')->name('country_delete')->middleware('perms:country_delete');
        });

        Route::group(['prefix' => 'city'], function () {
            Route::get('/', 'dashboard\CityController@index')->name('cities')->middleware('perms:cities');
            Route::get('create', 'dashboard\CityController@create')->name('city_create')->middleware('perms:city_create');
            Route::post('store', 'dashboard\CityController@store')->name('city_store')->middleware('perms:city_create');
            Route::get('edit/{id?}', 'dashboard\CityController@edit')->name('city_edit')->middleware('perms:city_edit');
            Route::post('update', 'dashboard\CityController@update')->name('city_update')->middleware('perms:city_edit');
            Route::get('delete/{id?}', 'dashboard\CityController@delete')->name('city_delete')->middleware('perms:city_delete');
        });

        Route::group(['prefix' => 'administration'], function () {
            // Groups
            Route::get('group', 'dashboard\AdministrationController@group')->name('administration_groups')->middleware('perms:administration');
            Route::get('group/create', 'dashboard\AdministrationController@group_create')->name('administration_group_create')->middleware('perms:administration');
            Route::post('group/store', 'dashboard\AdministrationController@group_store')->name('administration_group_store')->middleware('perms:administration');
            Route::get('group/edit/{id?}', 'dashboard\AdministrationController@group_edit')->name('administration_group_edit')->middleware('perms:administration');
            Route::post('group/update', 'dashboard\AdministrationController@group_update')->name('administration_group_update')->middleware('perms:administration');
            Route::get('group/delete/{id?}', 'dashboard\AdministrationController@group_delete')->name('administration_group_delete')->middleware('perms:administration');
            // Admins
            Route::get('admins', 'dashboard\AdministrationController@admins')->name('admins')->middleware('perms:administration');
            Route::get('admin/create', 'dashboard\AdministrationController@admin_create')->name('admin_create')->middleware('perms:administration');
            Route::post('admin/store', 'dashboard\AdministrationController@admin_store')->name('admin_store')->middleware('perms:administration');
            Route::get('admin/edit/{id?}', 'dashboard\AdministrationController@admin_edit')->name('admin_edit')->middleware('perms:administration');
            Route::post('admin/update', 'dashboard\AdministrationController@admin_update')->name('admin_update')->middleware('perms:administration');
            Route::get('admin/delete/{id?}', 'dashboard\AdministrationController@admin_delete')->name('admin_delete')->middleware('perms:administration');
        });
        //user nationality routes
        Route::group(['prefix' => 'nationality'], function () {
            Route::get('/', 'dashboard\NationalitiesController@index')->name('nationality')->middleware('perms:nationality');
            Route::get('create', 'dashboard\NationalitiesController@create')->name('nationality_create')->middleware('perms:nationality');
            Route::post('store', 'dashboard\NationalitiesController@store')->name('nationality_store')->middleware('perms:nationality');
            Route::get('edit/{id?}', 'dashboard\NationalitiesController@edit')->name('nationality_edit')->middleware('perms:nationality');
            Route::post('update', 'dashboard\NationalitiesController@update')->name('nationality_update')->middleware('perms:nationality');
            Route::get('delete/{id?}', 'dashboard\NationalitiesController@delete')->name('nationality_delete')->middleware('perms:nationality');
        });

        //categories routes
        Route::group(['prefix' => 'category'], function () {
            Route::get('/', 'dashboard\CategoryController@index')->name('category')->middleware('perms:category');
            Route::get('create', 'dashboard\CategoryController@create')->name('category_create')->middleware('perms:category');
            Route::post('store', 'dashboard\CategoryController@store')->name('category_store')->middleware('perms:category');
            Route::get('edit/{id?}', 'dashboard\CategoryController@edit')->name('category_edit')->middleware('perms:category');
            Route::post('update', 'dashboard\CategoryController@update')->name('category_update')->middleware('perms:category');
            Route::get('delete/{id?}', 'dashboard\CategoryController@delete')->name('category_delete')->middleware('perms:category');
        });

        //offers routes
        Route::group(['prefix' => 'offer'], function () {
            Route::get('/', 'dashboard\OfferController@index')->name('offer')->middleware('perms:offer');
            Route::get('create', 'dashboard\OfferController@create')->name('offer_create')->middleware('perms:offer');
            Route::post('store', 'dashboard\OfferController@store')->name('offer_store')->middleware('perms:offer');
            Route::get('edit/{id?}', 'dashboard\OfferController@edit')->name('offer_edit')->middleware('perms:offer');
            Route::post('update', 'dashboard\OfferController@update')->name('offer_update')->middleware('perms:offer');
            Route::get('delete/{id?}', 'dashboard\OfferController@delete')->name('offer_delete')->middleware('perms:offer');
        });

        //offers routes
        Route::group(['prefix' => 'useroffer'], function () {
            Route::get('/', 'dashboard\UserOfferController@index')->name('useroffer')->middleware('perms:useroffer');
            Route::get('create', 'dashboard\UserOfferController@create')->name('useroffer_create')->middleware('perms:useroffer');
            Route::post('store', 'dashboard\UserOfferController@store')->name('useroffer_store')->middleware('perms:useroffer');
            Route::get('edit/{id?}', 'dashboard\UserOfferController@edit')->name('useroffer_edit')->middleware('perms:useroffer');
            Route::post('update', 'dashboard\UserOfferController@update')->name('useroffer_update')->middleware('perms:useroffer');
            Route::get('delete/{id?}', 'dashboard\UserOfferController@delete')->name('useroffer_delete')->middleware('perms:useroffer');
        });

        //messages routes
        Route::group(['prefix' => 'message'], function () {
            Route::get('/', 'dashboard\MessageController@index')->name('message')->middleware('perms:message');
            Route::get('create', 'dashboard\MessageController@create')->name('message_create')->middleware('perms:message');
            Route::post('store', 'dashboard\MessageController@store')->name('message_store')->middleware('perms:message');
            Route::get('edit/{id?}', 'dashboard\MessageController@edit')->name('message_edit')->middleware('perms:message');
            Route::post('update', 'dashboard\MessageController@update')->name('message_update')->middleware('perms:message');
            Route::get('delete/{id?}', 'dashboard\MessageController@delete')->name('message_delete')->middleware('perms:message');
        });

        //contacts routes
        Route::group(['prefix' => 'contact'], function () {
            Route::get('/', 'dashboard\ContactController@index')->name('contact')->middleware('perms:contact');
            Route::get('create', 'dashboard\ContactController@create')->name('contact_create')->middleware('perms:contact');
            Route::post('store', 'dashboard\ContactController@store')->name('contact_store')->middleware('perms:contact');
            Route::get('edit/{id?}', 'dashboard\ContactController@edit')->name('contact_edit')->middleware('perms:contact');
            Route::post('update', 'dashboard\ContactController@update')->name('contact_update')->middleware('perms:contact');
            Route::get('delete/{id?}', 'dashboard\ContactController@delete')->name('contact_delete')->middleware('perms:contact');
        });

        Route::group(['prefix' => 'review'], function () {
            Route::get('/', 'dashboard\ReviewController@index')->name('review')->middleware('perms:review');
            Route::get('create', 'dashboard\ReviewController@create')->name('review_create')->middleware('perms:review');
            Route::post('store', 'dashboard\ReviewController@store')->name('review_store')->middleware('perms:review');
            Route::get('edit/{id?}', 'dashboard\ReviewController@edit')->name('review_edit')->middleware('perms:review');
            Route::post('update', 'dashboard\ReviewController@update')->name('review_update')->middleware('perms:review');
            Route::get('delete/{id?}', 'dashboard\ReviewController@delete')->name('review_delete')->middleware('perms:review');
        });

        Route::group(['prefix' => 'comment'], function () {
            Route::get('/', 'dashboard\CommentController@index')->name('comment')->middleware('perms:comment');
            Route::get('create', 'dashboard\CommentController@create')->name('comment_create')->middleware('perms:comment');
            Route::post('store', 'dashboard\CommentController@store')->name('comment_store')->middleware('perms:comment');
            Route::get('edit/{id?}', 'dashboard\CommentController@edit')->name('comment_edit')->middleware('perms:comment');
            Route::post('update', 'dashboard\CommentController@update')->name('comment_update')->middleware('perms:comment');
            Route::get('delete/{id?}', 'dashboard\CommentController@delete')->name('comment_delete')->middleware('perms:comment');
        });

        //user routes
        Route::group(['prefix' => 'user'], function () {
            Route::get('/', 'dashboard\UserController@index')->name('user')->middleware('perms:user');
            Route::get('create', 'dashboard\UserController@create')->name('user_create')->middleware('perms:user');
            Route::post('store', 'dashboard\UserController@store')->name('user_store')->middleware('perms:user');
            Route::get('edit/{id?}', 'dashboard\UserController@edit')->name('user_edit')->middleware('perms:user');
            Route::post('update/{id?}', 'dashboard\UserController@update')->name('user_update')->middleware('perms:user');
            Route::get('delete/{id?}', 'dashboard\UserController@delete')->name('user_delete')->middleware('perms:user');
            Route::get('trashed', 'dashboard\UserController@trashed')->name('user_trashed')->middleware('perms:user');
            Route::get('restore/{id?}', 'dashboard\UserController@restore')->name('user_restore')->middleware('perms:user');
            Route::get('force_delete/{id?}', 'dashboard\UserController@force_delete')->name('user_force_delete')->middleware('perms:user');
            Route::get('profile/{id?}', 'dashboard\UserController@profile')->name('user_profile')->middleware('perms:user');
            Route::post('wallet', 'dashboard\UserController@wallet')->name('user_wallet')->middleware('perms:user');
            Route::get('live_search_4_driver/{id?}', 'dashboard\UserController@live_search_4_driver')->name('live_search_4_client')->middleware('perms:user');
        });

        Route::group(['prefix' => 'bank_account'], function () {
            Route::get('/', 'dashboard\BankAccountController@index')->name('bank_account')->middleware('perms:bank_account');
            Route::get('create', 'dashboard\BankAccountController@create')->name('bank_account_create')->middleware('perms:bank_account_create');
            Route::post('store', 'dashboard\BankAccountController@store')->name('bank_account_store')->middleware('perms:bank_account_create');
            Route::get('edit/{id?}', 'dashboard\BankAccountController@edit')->name('bank_account_edit')->middleware('perms:bank_account_edit');
            Route::post('update', 'dashboard\BankAccountController@update')->name('bank_account_update')->middleware('perms:bank_account_edit');
            Route::get('delete/{id?}', 'dashboard\BankAccountController@delete')->name('bank_account_delete')->middleware('perms:bank_account_delete');
        });

    });
});
