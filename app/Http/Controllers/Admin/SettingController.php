<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->all();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'settings' => 'required|array',
            'header_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = $validated['settings'];

        // Handle header background image upload if provided
        if ($request->hasFile('header_image')) {
            // Optional: delete old image if it exists
            $oldImage = Setting::where('key', 'header_image')->value('value');
            if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                Storage::disk('public')->delete($oldImage);
            }

            $path = $request->file('header_image')->store('settings', 'public');
            $data['header_image'] = $path;
        }

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value ?? '']
            );
        }

        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully.');
    }
}