<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\PARENT_DASHBOARD;
use App\Model\Setting;

class SettingController extends PARENT_DASHBOARD
{
    protected $mainRedirect = 'dashboard.setting.';
    public function index()
    {
        return view($this->mainRedirect . "index");
    }

    public function update(Request $request)
    {
        if ($request->APP_NAME_AR) {
            $this->update_setting('APP_NAME_AR', $request->APP_NAME_AR);
        }
        if ($request->APP_NAME_EN) {
            $this->update_setting('APP_NAME_EN', $request->APP_NAME_EN);
        }
        if ($request->APP_DESC_AR) {
            $this->update_setting('APP_DESC_AR', $request->APP_DESC_AR);
        }
        if ($request->APP_DESC_EN) {
            $this->update_setting('APP_DESC_EN', $request->APP_DESC_EN);
        }
        if ($request->FACEBOOK_URL) {
            $this->update_setting('FACEBOOK_URL', $request->FACEBOOK_URL);
        }
        if ($request->TWITTER_URL) {
            $this->update_setting('TWITTER_URL', $request->TWITTER_URL);
        }
        if ($request->INSTAGRAM_URL) {
            $this->update_setting('INSTAGRAM_URL', $request->INSTAGRAM_URL);
        }
        if ($request->SNAPCHAT_URL) {
            $this->update_setting('SNAPCHAT_URL', $request->SNAPCHAT_URL);
        }
        if ($request->MOBILE) {
            $this->update_setting('MOBILE', $request->MOBILE);
        }
        if ($request->FORMAL_EMAIL) {
            $this->update_setting('FORMAL_EMAIL', $request->FORMAL_EMAIL);
        }
        if ($request->SMTP_HOST) {
            $this->update_setting('SMTP_HOST', $request->SMTP_HOST);
        }
        if ($request->SMTP_PORT) {
            $this->update_setting('SMTP_PORT', $request->SMTP_PORT);
        }
        if ($request->SMTP_EMAIL) {
            $this->update_setting('SMTP_EMAIL', $request->SMTP_EMAIL);
        }
        if ($request->SMTP_PASSWORD) {
            $this->update_setting('SMTP_PASSWORD', $request->SMTP_PASSWORD);
        }
        if ($request->ABOUT_AR) {
            $this->update_setting('ABOUT_AR', $request->ABOUT_AR);
        }
        if ($request->ABOUT_EN) {
            $this->update_setting('ABOUT_EN', $request->ABOUT_EN);
        }
        if ($request->SMS_PROVIDER_SENDER) {
            $this->update_setting('SMS_PROVIDER_SENDER', $request->SMS_PROVIDER_SENDER);
        }
        if ($request->SMS_PROVIDER_MOBILE) {
            $this->update_setting('SMS_PROVIDER_MOBILE', $request->SMS_PROVIDER_MOBILE);
        }
        if ($request->SMS_PROVIDER_PASSWORD) {
            $this->update_setting('SMS_PROVIDER_PASSWORD', $request->SMS_PROVIDER_PASSWORD);
        }

        if ($request->PRIVACY_POLICY_AR) {
            $this->update_setting('PRIVACY_POLICY_AR', $request->PRIVACY_POLICY_AR);
        }
        if ($request->PRIVACY_POLICY_EN) {
            $this->update_setting('PRIVACY_POLICY_EN', $request->PRIVACY_POLICY_EN);
        }
        if ($request->TERMS_AR) {
            $this->update_setting('TERMS_AR', $request->TERMS_AR);
        }
        if ($request->TERMS_EN) {
            $this->update_setting('TERMS_EN', $request->TERMS_EN);
        }


        // MK_REPORT('dashboard_update_settings', 'Update Settings ', Setting::all());
        return back()
            ->with('swal', trans('dash.date_updated_successfully'))
            ->with('icon', 'success')
            ->with('class', 'alert alert-success')
            ->with('message', trans('dash.date_updated_successfully'));
    }

    function update_setting($key, $value)
    {
        Setting::where('key', $key)->update(['value' => $value]);
        return true;
    }
}
