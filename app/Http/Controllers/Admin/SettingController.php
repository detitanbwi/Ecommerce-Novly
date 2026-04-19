<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $whatsappNumber = Setting::where('key', 'whatsapp_number')->value('value');
        return view('admin.settings', compact('whatsappNumber'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'whatsapp_number' => 'required|string',
        ]);

        Setting::updateOrCreate(
            ['key' => 'whatsapp_number'],
            ['value' => $request->whatsapp_number]
        );

        return back()->with('success', 'Pengaturan berhasil diperbarui!');
    }
}
