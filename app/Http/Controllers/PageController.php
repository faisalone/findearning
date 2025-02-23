<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Middleware\AdminMiddleware;

class PageController extends Controller
{
	public function __construct()
    {
        $this->middleware(AdminMiddleware::class)->except('show');
    }
    /**
     * Display a listing of the resource.
     */
	public function index()
	{
		// Retrieve all pages with pagination
		$pages = Page::paginate(10);
		return view('dashboard.pages.index', compact('pages'));
	}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
	public function store(Request $request)
	{
		// Validate request data
		$validated = $request->validate([
			'title' => 'required|string|max:255',
			'content' => 'required',
			'position' => 'nullable|integer',
			'status' => 'required|boolean',
		]);

		// Generate slug from title
		$validated['slug'] = Str::slug($validated['title']);

		// Ensure the slug is unique
		$slugCount = Page::where('slug', 'like', $validated['slug'] . '%')->count();
		if ($slugCount > 0) {
			$validated['slug'] .= '-' . ($slugCount + 1);
		}

		Page::create($validated);
		
		return redirect()->route('pages.index')->with('success', 'Page created successfully.');
	}

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        // You can add dashboard-specific show functionality if needed
        return view('pages.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        return view('dashboard.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $page) // removed type-hint
    {
        // Fetch the model instance using the provided id
        $page = Page::findOrFail($page);

        $validated = $request->validate([
            'title'    => 'required|string|max:255',
            'content'  => 'required',
            'position' => 'nullable|integer',
            'status'   => 'required|boolean',
        ]);

        // Generate slug from title and ensure uniqueness
        $validated['slug'] = Str::slug($validated['title']);
        $slugCount = Page::where('slug', 'like', $validated['slug'] . '%')->where('id', '!=', $page->id)->count();
        if ($slugCount > 0) {
            $validated['slug'] .= '-' . ($slugCount + 1);
        }

        $page->update($validated);
        return redirect()->route('pages.index')->with('success', 'Page updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('pages.index')->with('success', 'Page deleted successfully.');
    }
}
