<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        Schema::defaultStringLength(191);

        // config(['mail.host' => SETTING_VALUE('SMTP_HOST')]);
        // config(['mail.port' => SETTING_VALUE('SMTP_PORT')]);
        // config(['mail.from.address' => SETTING_VALUE('FORMAL_EMAIL')]);
        // config(['mail.username' => SETTING_VALUE('SMTP_EMAIL')]);
        // config(['mail.password' => SETTING_VALUE('SMTP_PASSWORD')]);

        // // config(['mail.driver' => SETTING_VALUE('SMTP_PORT')]);
        // // config(['mail.from.name' => SETTING_VALUE('SMTP_PORT')]);
        // // config(['mail.encryption' => SETTING_VALUE('SMTP_PORT')]);

        // config(['fcm.http.server_key' => SETTING_VALUE('FCM_SERVER_KEY')]);
        // config(['fcm.http.sender_id' => SETTING_VALUE('FCM_SENDER_ID')]);

        // config(['mobilysms.sender' => SETTING_VALUE('MOBILY_SENDER')]);
        // config(['mobilysms.mobile' => SETTING_VALUE('MOBILY_MOBILE')]);
        // config(['mobilysms.password' => SETTING_VALUE('MOBILY_PASSWORD')]);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Validator::extend('lang_lat', function($attribute, $value)
        {
          return preg_match('/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/', $value);
        });

    }
}
