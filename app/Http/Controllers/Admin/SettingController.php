<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit()
    {
        return view('admin.settings.edit', ['settings' => SiteSetting::values()]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'site_name' => ['required', 'string', 'max:100'],
            'footer_text' => ['required', 'string', 'max:255'],
            'facebook_url' => ['nullable', 'url', 'max:255'],
            'instagram_url' => ['nullable', 'url', 'max:255'],
            'home_hero_title' => ['required', 'string', 'max:255'],
            'home_hero_highlight' => ['required', 'string', 'max:255'],
            'home_hero_description' => ['required', 'string', 'max:1000'],
            'home_packages_title' => ['required', 'string', 'max:255'],
            'home_packages_description' => ['required', 'string', 'max:1000'],
            'packages_title' => ['required', 'string', 'max:255'],
            'packages_description' => ['required', 'string', 'max:1000'],
            'games_title' => ['required', 'string', 'max:255'],
            'games_description' => ['required', 'string', 'max:1000'],
            'contact_title' => ['required', 'string', 'max:255'],
            'contact_description' => ['required', 'string', 'max:1000'],
            'contact_address' => ['required', 'string', 'max:1000'],
            'contact_phone' => ['required', 'string', 'max:50'],
            'contact_email' => ['required', 'email', 'max:255'],
        ]);

        SiteSetting::putMany($data);

        return back()->with('success', 'Pengaturan situs berhasil disimpan.');
    }
}
