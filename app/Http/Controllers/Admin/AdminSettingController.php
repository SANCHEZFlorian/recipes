<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class AdminSettingController extends Controller
{
    public function index()
    {
        // For now, settings are just a placeholder view since there's no DB table for them yet.
        return Inertia::render('Admin_setting', [
            'settings' => [] // Empty array for now
        ]);
    }
}
