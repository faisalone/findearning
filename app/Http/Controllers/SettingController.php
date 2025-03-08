<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware(AdminMiddleware::class);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::orderBy('key', 'asc')->get();
        return view('dashboard.settings.index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.settings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required|string|max:255|unique:settings,key',
            'value' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only(['key', 'value']);
        
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('settings', 'public');
            $data['image'] = $imagePath;
        }

        Setting::create($data);
        
        return redirect()->route('settings.index')
            ->with('success', 'Setting created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        return view('dashboard.settings.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        $request->validate([
            'value' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only(['value']);
        
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($setting->image) {
                Storage::disk('public')->delete($setting->image);
            }
            
            $imagePath = $request->file('image')->store('settings', 'public');
            $data['image'] = $imagePath;
        }

        $setting->update($data);
        
        return redirect()->route('settings.index')
            ->with('success', 'Setting updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        // Delete image if exists
        if ($setting->image) {
            Storage::disk('public')->delete($setting->image);
        }
        
        $setting->delete();
        
        return redirect()->route('settings.index')
            ->with('success', 'Setting deleted successfully.');
    }
}
