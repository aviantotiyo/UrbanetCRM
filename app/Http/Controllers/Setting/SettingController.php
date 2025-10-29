<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\DataSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Tampilkan form edit setting.
     */
    public function edit()
    {
        // Ambil hanya baris pertama (misal hanya ada 1 setting)
        $setting = DataSetting::firstOrCreate([], []);

        return view('setting.setting', compact('setting'));
    }

    /**
     * Proses update setting.
     */
    public function update(Request $request)
    {
        $request->validate([
            'denda'                 => 'nullable|integer',
            'point'                 => 'nullable|integer',
            'tax'                   => 'nullable|integer',
            'fee_merchant_billing' => 'nullable|integer',
            'fee_merchant_sales'   => 'nullable|integer',
            'fee_sales_internal'   => 'nullable|integer',
            'fee_engineer_sales'   => 'nullable|integer',
            'fee_engineer'         => 'nullable|integer',
        ]);

        $setting = DataSetting::first();
        if ($setting) {
            $setting->update($request->all());
        }

        return redirect()->back()->with('success', 'Pengaturan berhasil diperbarui.');
    }
}
