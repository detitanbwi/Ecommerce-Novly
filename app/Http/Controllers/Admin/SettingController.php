<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini tidak cocok.']);
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success', 'Password berhasil diperbarui!');
    }
}
