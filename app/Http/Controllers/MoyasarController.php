<?php

namespace App\Http\Controllers;

use App\BusinessSetting;
use App\Currency;
use App\Order;

use Illuminate\Http\Request;

class MoyasarController extends Controller
{

public function pay($request) {

    $order = Order::findOrFail($request->session()->get('order_id'));

        $Currency = Currency::find(\App\BusinessSetting::where('type', 'system_default_currency')->first()->value);
        $Moyasar_SECRET_KEY = \App\BusinessSetting::where('type', 'Moyasar_SECRET_KEY')->first()->value;


        return view('frontend.moyasar.moyasar', compact('order', 'Currency','Moyasar_SECRET_KEY'));

    }
    function MoyasarOrderConfirmed(Request $request)
    {
        $order = Order::findOrFail($request->session()->get('order_id'));
        $order_id = $request->session()->get('order_id');

        $payment_detalis = $request->id;
        if (!empty($request->message) && $request->message == 'Succeeded!') {
            $checkoutController = new CheckoutController;
            return $checkoutController->checkout_done($order_id, $payment_detalis);
        }else{
            flash(translate('Payment Failed'))->success();
            return redirect()->url()->previous();
        }

    }



    function callback(Request $request){


    }
}
