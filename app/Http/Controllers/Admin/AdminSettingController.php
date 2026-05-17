<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminSettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();

        return Inertia::render('Admin_setting', [
            'settings' => $settings
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'contact_email' => 'required|email|max:255',
            'site_description' => 'nullable|string',
            'maintenance_mode' => 'required|boolean',
        ]);

        foreach ($validated as $key => $value) {
            Setting::set($key, (string)$value);
        }

        return redirect()->back()->with('success', 'Paramètres mis à jour avec succès.');
    }
}
