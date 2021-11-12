<?php

namespace App\Http\Controllers\Panel;

use App\Bank;
use App\Country;
use Illuminate\Http\Request;
use App\Config;

class ConfigController extends BaseController
{
    function __construct(){
        parent::__construct();
    }

    public function index(){
        $configs = Config::getSettings(['customer_requests_at_time','customer_requests_per_day',
		'customer_requests_per_month','delegates_requests_at_time','delegates_requests_per_day',
		'delegates_requests_per_month','order_remains_active']);
        return view('panel.configs.index', compact('configs'));
    }

    public function updateConfigs(Request $request){
        Config::setConfigs($request->only([ // to avoid store _token and method
		        'customer_requests_at_time','customer_requests_per_day','customer_requests_per_month','order_remains_active',
                'delegates_requests_at_time','delegates_requests_per_day','delegates_requests_per_month'
		]));
        session()->flash('alert' , ['title' => 'تم', 'message' => 'تم تحديث الاعدادات بنجاح', 'type' => 'success']);
        return back();
    }

    public function customersAndDelegates(){
        $configs = Config::getConfigs([
                'customer_requests_at_time','customer_requests_per_day','customer_requests_per_month','order_remains_active',
                'delegates_requests_at_time','delegates_requests_per_day','delegates_requests_per_month'
            ]);
        return view('panel.configs.users-and-operations', compact('configs'));
    }
}
