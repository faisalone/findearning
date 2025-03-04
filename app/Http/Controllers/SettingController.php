<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Middleware\AdminMiddleware;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required|string|max:255|unique:settings,key',
            'value' => 'required|string'
        ]);

        Setting::create($request->only(['key', 'value']));
        
        return redirect()->route('settings.index')
            ->with('success', 'Setting created successfully.');
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
        $request->validate([
            'value' => 'required|string'
        ]);

        $setting->value = $request->value;
        $setting->save();
        
        return redirect()->route('settings.index')
            ->with('success', 'Setting updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        $setting->delete();
        
        return redirect()->route('settings.index')
            ->with('success', 'Setting deleted successfully.');
    }
}
