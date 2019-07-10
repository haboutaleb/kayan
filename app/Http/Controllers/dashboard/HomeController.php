<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\PARENT_DASHBOARD;
use Carbon\Carbon;

class HomeController extends PARENT_DASHBOARD
{
    public function index()
    {

        $this->data['cities_counter'] = \App\Model\City::count();

        $this->data['order_deliverd_counter'] = 1;
        $this->data['order_active_counter'] = 1;
        $this->data['users_active_counter'] = 1;

        $this->data['provider_active_counter'] = \App\User::where('type', 'provider')->where('active', 'active')->count();
        $this->data['users_deactive_counter'] = \App\User::where('type', 'client')->where('active', '!=', 'active')->count();
        $this->data['provider_deactive_counter'] = \App\User::where('type', 'provider')->where('active', '!=', 'active')->count();


        // Charts Statics
        Carbon::setLocale('ar');
        $this->data['current_month'] = Carbon::now()->endOfMonth()->format('Y-M');
        $this->data['sub_1_month'] = Carbon::now()->endOfMonth()->subMonth(1)->format('Y-M');
        $this->data['sub_2_month'] = Carbon::now()->endOfMonth()->subMonth(2)->format('Y-M');
        $this->data['sub_3_month'] = Carbon::now()->endOfMonth()->subMonth(3)->format('Y-M');
        $this->data['sub_4_month'] = Carbon::now()->endOfMonth()->subMonth(4)->format('Y-M');
        $this->data['sub_5_month'] = Carbon::now()->endOfMonth()->subMonth(5)->format('Y-M');
        $this->data['sub_6_month'] = Carbon::now()->endOfMonth()->subMonth(6)->format('Y-M');
        $this->data['sub_7_month'] = Carbon::now()->endOfMonth()->subMonth(7)->format('Y-M');
        $this->data['sub_8_month'] = Carbon::now()->endOfMonth()->subMonth(8)->format('Y-M');
        $this->data['sub_9_month'] = Carbon::now()->endOfMonth()->subMonth(9)->format('Y-M');
        $this->data['sub_10_month'] = Carbon::now()->endOfMonth()->subMonth(10)->format('Y-M');
        $this->data['sub_11_month'] = Carbon::now()->endOfMonth()->subMonth(11)->format('Y-M');

        $this->data['normal_user_count_current_month'] = \App\User::where('type', 'client')->where('created_at', '>=', Carbon::now()->startOfMonth()->format('Y-m-d H:i:s'))->where('created_at', '<=', Carbon::now()->endOfMonth()->format('Y-m-d H:i:s'))->count();
        $this->data['normal_user_count_sub_1_month']   = \App\User::where('type', 'client')->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth(1)->format('Y-m-d H:i:s'))->where('created_at', '<=', Carbon::now()->endOfMonth()->subMonth(1)->format('Y-m-d H:i:s'))->count();
        $this->data['normal_user_count_sub_2_month']   = \App\User::where('type', 'client')->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth(2)->format('Y-m-d H:i:s'))->where('created_at', '<=', Carbon::now()->endOfMonth()->subMonth(2)->format('Y-m-d H:i:s'))->count();
        $this->data['normal_user_count_sub_3_month']   = \App\User::where('type', 'client')->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth(3)->format('Y-m-d H:i:s'))->where('created_at', '<=', Carbon::now()->endOfMonth()->subMonth(3)->format('Y-m-d H:i:s'))->count();
        $this->data['normal_user_count_sub_4_month']   = \App\User::where('type', 'client')->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth(4)->format('Y-m-d H:i:s'))->where('created_at', '<=', Carbon::now()->endOfMonth()->subMonth(4)->format('Y-m-d H:i:s'))->count();
        $this->data['normal_user_count_sub_5_month']   = \App\User::where('type', 'client')->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth(5)->format('Y-m-d H:i:s'))->where('created_at', '<=', Carbon::now()->endOfMonth()->subMonth(5)->format('Y-m-d H:i:s'))->count();
        $this->data['normal_user_count_sub_6_month']   = \App\User::where('type', 'client')->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth(6)->format('Y-m-d H:i:s'))->where('created_at', '<=', Carbon::now()->endOfMonth()->subMonth(6)->format('Y-m-d H:i:s'))->count();
        $this->data['normal_user_count_sub_7_month']   = \App\User::where('type', 'client')->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth(7)->format('Y-m-d H:i:s'))->where('created_at', '<=', Carbon::now()->endOfMonth()->subMonth(7)->format('Y-m-d H:i:s'))->count();
        $this->data['normal_user_count_sub_8_month']   = \App\User::where('type', 'client')->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth(8)->format('Y-m-d H:i:s'))->where('created_at', '<=', Carbon::now()->endOfMonth()->subMonth(8)->format('Y-m-d H:i:s'))->count();
        $this->data['normal_user_count_sub_9_month']   = \App\User::where('type', 'client')->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth(9)->format('Y-m-d H:i:s'))->where('created_at', '<=', Carbon::now()->endOfMonth()->subMonth(9)->format('Y-m-d H:i:s'))->count();
        $this->data['normal_user_count_sub_10_month']  = \App\User::where('type', 'client')->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth(10)->format('Y-m-d H:i:s'))->where('created_at', '<=', Carbon::now()->endOfMonth()->subMonth(10)->format('Y-m-d H:i:s'))->count();
        $this->data['normal_user_count_sub_11_month']  = \App\User::where('type', 'client')->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth(11)->format('Y-m-d H:i:s'))->where('created_at', '<=', Carbon::now()->endOfMonth()->subMonth(11)->format('Y-m-d H:i:s'))->count();


        $this->data['fitness_expert_count_current_month'] = \App\User::where('type', 'client')->where('created_at', '>=', Carbon::now()->startOfMonth()->format('Y-m-d H:i:s'))->where('created_at', '<=', Carbon::now()->endOfMonth()->format('Y-m-d H:i:s'))->count();
        $this->data['fitness_expert_count_sub_1_month']   = \App\User::where('type', 'client')->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth(1)->format('Y-m-d H:i:s'))->where('created_at', '<=', Carbon::now()->endOfMonth()->subMonth(1)->format('Y-m-d H:i:s'))->count();
        $this->data['fitness_expert_count_sub_2_month']   = \App\User::where('type', 'client')->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth(2)->format('Y-m-d H:i:s'))->where('created_at', '<=', Carbon::now()->endOfMonth()->subMonth(2)->format('Y-m-d H:i:s'))->count();
        $this->data['fitness_expert_count_sub_3_month']   = \App\User::where('type', 'client')->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth(3)->format('Y-m-d H:i:s'))->where('created_at', '<=', Carbon::now()->endOfMonth()->subMonth(3)->format('Y-m-d H:i:s'))->count();
        $this->data['fitness_expert_count_sub_4_month']   = \App\User::where('type', 'client')->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth(4)->format('Y-m-d H:i:s'))->where('created_at', '<=', Carbon::now()->endOfMonth()->subMonth(4)->format('Y-m-d H:i:s'))->count();
        $this->data['fitness_expert_count_sub_5_month']   = \App\User::where('type', 'client')->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth(5)->format('Y-m-d H:i:s'))->where('created_at', '<=', Carbon::now()->endOfMonth()->subMonth(5)->format('Y-m-d H:i:s'))->count();
        $this->data['fitness_expert_count_sub_6_month']   = \App\User::where('type', 'client')->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth(6)->format('Y-m-d H:i:s'))->where('created_at', '<=', Carbon::now()->endOfMonth()->subMonth(6)->format('Y-m-d H:i:s'))->count();
        $this->data['fitness_expert_count_sub_7_month']   = \App\User::where('type', 'client')->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth(7)->format('Y-m-d H:i:s'))->where('created_at', '<=', Carbon::now()->endOfMonth()->subMonth(7)->format('Y-m-d H:i:s'))->count();
        $this->data['fitness_expert_count_sub_8_month']   = \App\User::where('type', 'client')->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth(8)->format('Y-m-d H:i:s'))->where('created_at', '<=', Carbon::now()->endOfMonth()->subMonth(8)->format('Y-m-d H:i:s'))->count();
        $this->data['fitness_expert_count_sub_9_month']   = \App\User::where('type', 'client')->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth(9)->format('Y-m-d H:i:s'))->where('created_at', '<=', Carbon::now()->endOfMonth()->subMonth(9)->format('Y-m-d H:i:s'))->count();
        $this->data['fitness_expert_count_sub_10_month']  = \App\User::where('type', 'client')->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth(10)->format('Y-m-d H:i:s'))->where('created_at', '<=', Carbon::now()->endOfMonth()->subMonth(10)->format('Y-m-d H:i:s'))->count();
        $this->data['fitness_expert_count_sub_11_month']  = \App\User::where('type', 'client')->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth(11)->format('Y-m-d H:i:s'))->where('created_at', '<=', Carbon::now()->endOfMonth()->subMonth(11)->format('Y-m-d H:i:s'))->count();


        $this->data['client_count_current_month'] = \App\User::where('type', 'client')->where('created_at', '>=', Carbon::now()->startOfMonth()->format('Y-m-d H:i:s'))->where('created_at', '<=', Carbon::now()->endOfMonth()->format('Y-m-d H:i:s'))->count();
        $this->data['client_count_sub_1_month']   = \App\User::where('type', 'client')->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth(1)->format('Y-m-d H:i:s'))->where('created_at', '<=', Carbon::now()->endOfMonth()->subMonth(1)->format('Y-m-d H:i:s'))->count();
        $this->data['client_count_sub_2_month']   = \App\User::where('type', 'client')->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth(2)->format('Y-m-d H:i:s'))->where('created_at', '<=', Carbon::now()->endOfMonth()->subMonth(2)->format('Y-m-d H:i:s'))->count();
        $this->data['client_count_sub_3_month']   = \App\User::where('type', 'client')->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth(3)->format('Y-m-d H:i:s'))->where('created_at', '<=', Carbon::now()->endOfMonth()->subMonth(3)->format('Y-m-d H:i:s'))->count();
        $this->data['client_count_sub_4_month']   = \App\User::where('type', 'client')->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth(4)->format('Y-m-d H:i:s'))->where('created_at', '<=', Carbon::now()->endOfMonth()->subMonth(4)->format('Y-m-d H:i:s'))->count();
        $this->data['client_count_sub_5_month']   = \App\User::where('type', 'client')->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth(5)->format('Y-m-d H:i:s'))->where('created_at', '<=', Carbon::now()->endOfMonth()->subMonth(5)->format('Y-m-d H:i:s'))->count();
        $this->data['client_count_sub_6_month']   = \App\User::where('type', 'client')->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth(6)->format('Y-m-d H:i:s'))->where('created_at', '<=', Carbon::now()->endOfMonth()->subMonth(6)->format('Y-m-d H:i:s'))->count();
        $this->data['client_count_sub_7_month']   = \App\User::where('type', 'client')->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth(7)->format('Y-m-d H:i:s'))->where('created_at', '<=', Carbon::now()->endOfMonth()->subMonth(7)->format('Y-m-d H:i:s'))->count();
        $this->data['client_count_sub_8_month']   = \App\User::where('type', 'client')->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth(8)->format('Y-m-d H:i:s'))->where('created_at', '<=', Carbon::now()->endOfMonth()->subMonth(8)->format('Y-m-d H:i:s'))->count();
        $this->data['client_count_sub_9_month']   = \App\User::where('type', 'client')->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth(9)->format('Y-m-d H:i:s'))->where('created_at', '<=', Carbon::now()->endOfMonth()->subMonth(9)->format('Y-m-d H:i:s'))->count();
        $this->data['client_count_sub_10_month']  = \App\User::where('type', 'client')->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth(10)->format('Y-m-d H:i:s'))->where('created_at', '<=', Carbon::now()->endOfMonth()->subMonth(10)->format('Y-m-d H:i:s'))->count();
        $this->data['client_count_sub_11_month']  = \App\User::where('type', 'client')->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth(11)->format('Y-m-d H:i:s'))->where('created_at', '<=', Carbon::now()->endOfMonth()->subMonth(11)->format('Y-m-d H:i:s'))->count();


        $this->data['provider_count_current_month'] = \App\User::where('type', 'provider')->where('created_at', '>=', Carbon::now()->startOfMonth()->format('Y-m-d H:i:s'))->where('created_at', '<=', Carbon::now()->endOfMonth()->format('Y-m-d H:i:s'))->count();
        $this->data['provider_count_sub_1_month']   = \App\User::where('type', 'provider')->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth(1)->format('Y-m-d H:i:s'))->where('created_at', '<=', Carbon::now()->endOfMonth()->subMonth(1)->format('Y-m-d H:i:s'))->count();
        $this->data['provider_count_sub_2_month']   = \App\User::where('type', 'provider')->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth(2)->format('Y-m-d H:i:s'))->where('created_at', '<=', Carbon::now()->endOfMonth()->subMonth(2)->format('Y-m-d H:i:s'))->count();
        $this->data['provider_count_sub_3_month']   = \App\User::where('type', 'provider')->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth(3)->format('Y-m-d H:i:s'))->where('created_at', '<=', Carbon::now()->endOfMonth()->subMonth(3)->format('Y-m-d H:i:s'))->count();
        $this->data['provider_count_sub_4_month']   = \App\User::where('type', 'provider')->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth(4)->format('Y-m-d H:i:s'))->where('created_at', '<=', Carbon::now()->endOfMonth()->subMonth(4)->format('Y-m-d H:i:s'))->count();
        $this->data['provider_count_sub_5_month']   = \App\User::where('type', 'provider')->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth(5)->format('Y-m-d H:i:s'))->where('created_at', '<=', Carbon::now()->endOfMonth()->subMonth(5)->format('Y-m-d H:i:s'))->count();
        $this->data['provider_count_sub_6_month']   = \App\User::where('type', 'provider')->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth(6)->format('Y-m-d H:i:s'))->where('created_at', '<=', Carbon::now()->endOfMonth()->subMonth(6)->format('Y-m-d H:i:s'))->count();
        $this->data['provider_count_sub_7_month']   = \App\User::where('type', 'provider')->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth(7)->format('Y-m-d H:i:s'))->where('created_at', '<=', Carbon::now()->endOfMonth()->subMonth(7)->format('Y-m-d H:i:s'))->count();
        $this->data['provider_count_sub_8_month']   = \App\User::where('type', 'provider')->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth(8)->format('Y-m-d H:i:s'))->where('created_at', '<=', Carbon::now()->endOfMonth()->subMonth(8)->format('Y-m-d H:i:s'))->count();
        $this->data['provider_count_sub_9_month']   = \App\User::where('type', 'provider')->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth(9)->format('Y-m-d H:i:s'))->where('created_at', '<=', Carbon::now()->endOfMonth()->subMonth(9)->format('Y-m-d H:i:s'))->count();
        $this->data['provider_count_sub_10_month']  = \App\User::where('type', 'provider')->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth(10)->format('Y-m-d H:i:s'))->where('created_at', '<=', Carbon::now()->endOfMonth()->subMonth(10)->format('Y-m-d H:i:s'))->count();
        $this->data['provider_count_sub_11_month']  = \App\User::where('type', 'provider')->where('created_at', '>=', Carbon::now()->startOfMonth()->subMonth(11)->format('Y-m-d H:i:s'))->where('created_at', '<=', Carbon::now()->endOfMonth()->subMonth(11)->format('Y-m-d H:i:s'))->count();


        $this->data['last_5_orders'] = array();
        $this->data['last_5_deliveries'] = array();
        $this->data['last_5_users'] = array();

        return view('dashboard.home.index', $this->data);
    }
}
