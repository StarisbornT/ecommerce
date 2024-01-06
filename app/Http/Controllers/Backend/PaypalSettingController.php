<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\PayPalSetting;
use App\Http\Controllers\Controller;

class PaypalSettingController extends Controller
{

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => ['required', 'integer'],
            'account_mode' => ['required', 'integer'],
            'country_name' => ['required', 'max:200'],
            'currency_name' => ['required', 'max:200'],
            'currency_rate' => ['required'],
            'client_id' => ['required'],
            'secret_key' => ['required']
        ]);

        $setting = PayPalSetting::updateOrCreate(
            ['id' => $id],
            [
                'status' => $request->status,
                'mode' => $request->account_mode,
                'country_name' => $request->country_name,
                'currency_name' => $request->currency_name,
                'currency_rate' => $request->currency_rate,
                'client_id' => $request->client_id,
                'secret_key' => $request->secret_key
            ]
            );

            toastr('Updated Successfully', 'success', 'Success');

            return redirect()->back();
    }


}
