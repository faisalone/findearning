<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;
use App\Http\Middleware\AdminMiddleware;

class SliderController extends Controller
{
	public function __construct()
    {
        $this->middleware(AdminMiddleware::class);
    }
	/**
	 * Display a listing of the slider.
	 */
	public function index()
	{
		$sliders = Slider::all();
		return view('dashboard.sliders.index', compact('sliders'));
	}

	/**
	 * Show the form for creating a new slider.
	 */
	public function create()
	{
		return view('dashboard.sliders.create');
	}

	/**
	 * Store a newly created slider in storage.
	 */
	public function store(Request $request)
	{
		$request->validate([
			'title' => 'required|string|max:255|unique:sliders,title',
			'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
		]);

		$imageName = uniqid() . '.' . $request->file('image')->extension();
		$request->file('image')->storeAs(Slider::IMAGE_FOLDER, $imageName, 'public');

		Slider::create([
			'title' => $request->title,
			'image' => $imageName,
		]);

		return redirect()->route('sliders.index')->with('success', 'Slider created successfully.');
	}

	/**
	 * Display the specified slider.
	 */
	public function show(string $id)
	{
		//
	}

	/**
	 * Show the form for editing the specified slider.
	 */
	public function edit(Slider $slider)
	{
		return view('dashboard.sliders.edit', compact('slider'));
	}

	/**
	 * Update the specified slider in storage.
	 */
	public function update(Request $request, Slider $slider)
	{
		$request->validate([
			'title' => 'required|string|max:255|unique:sliders,title,' . $slider->id,
			'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
		]);

		if ($request->hasFile('image')) {
			if ($slider->image) {
				Storage::disk('public')->delete(Slider::IMAGE_FOLDER . '/' . $slider->image);
			}

			$imageName = uniqid() . '.' . $request->file('image')->extension();
			$request->file('image')->storeAs(Slider::IMAGE_FOLDER, $imageName, 'public');
			$slider->image = $imageName;
		}

		$slider->update([
			'title' => $request->title,
		]);

		return redirect()->route('sliders.index')->with('success', 'Slider updated successfully.');
	}

	/**
	 * Remove the specified slider from storage.
	 */
	public function destroy(Slider $slider)
	{
		if ($slider->image) {
			Storage::disk('public')->delete(Slider::IMAGE_FOLDER . '/' . $slider->image);
		}

		$slider->delete();

		return redirect()->route('sliders.index')->with('success', 'Slider deleted successfully.');
	}
}
