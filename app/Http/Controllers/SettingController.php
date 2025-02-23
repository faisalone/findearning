<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.settings.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'settings' => ['required', 'array'],
            'settings.title' => ['required', 'string', 'max:255'],
            'settings.email' => ['required', 'email'],
            'settings.description' => ['required', 'string'],
            'settings.keywords' => ['nullable', 'string'],
            'settings.favicon' => ['nullable', 'image', 'mimes:ico,svg,png,jpg,jpeg,gif', 'max:2048'],
            'settings.og-image' => ['nullable', 'image', 'mimes:svg,webp,png,jpg,jpeg', 'max:2048']
        ]);

        foreach ($request->settings as $key => $value) {
            if ($request->hasFile("settings.{$key}")) {
                $file = $request->file("settings.{$key}");
                $filename = $file->getClientOriginalName();                
                // Move the file directly to public directory
                $file->move(public_path(), $filename);
                
                Setting::set($key, $filename);
            } else {
                Setting::set($key, $value);
            }
        }

        return redirect()->route('settings.index')
            ->with('success', 'Settings updated successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
