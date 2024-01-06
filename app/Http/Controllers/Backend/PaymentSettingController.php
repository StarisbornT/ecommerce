<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\PayPalSetting;
use App\Models\StripeSetting;
use App\Models\PaystackSetting;
use App\Models\RazorPaySetting;
use App\Http\Controllers\Controller;

class PaymentSettingController extends Controller
{
    public function index() {
        $paypalSetting = PayPalSetting::first();
        $stripeSetting = StripeSetting::first();
        $razorpaySetting = RazorPaySetting::first();
        $paystackSetting = PaystackSetting::first();
        return view('admin.payment-setting.index', compact('paypalSetting', 'stripeSetting', 'razorpaySetting', 'paystackSetting'));
    }
}