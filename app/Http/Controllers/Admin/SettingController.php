<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit()
    {
        $rate = Setting::where('key', 'exchange_rate_usd_to_cdf')->first();
        return view('admin.settings.edit', compact('rate'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'exchange_rate' => 'required|numeric|min:0.01',
        ]);

        Setting::updateOrCreate(
            ['key' => 'exchange_rate_usd_to_cdf'],
            ['value' => $request->exchange_rate]
        );

        return redirect()->route('admin.settings.edit')->with('success', 'Taux de change mis à jour.');
    }
}