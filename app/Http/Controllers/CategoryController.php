<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Middleware\AdminMiddleware;

class CategoryController extends Controller
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
        $categories = Category::withCount('products')->get();
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:categories,title',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string',
        ]);

        $slug = Str::slug($request->title);
        if (Category::where('slug', $slug)->exists()) {
            return back()->withErrors(['title' => 'The title is too similar to an existing category. Please try a different name.'])->withInput();
        }

        $imageName = uniqid() . '.' . $request->file('image')->extension();
        $request->file('image')->storeAs(Category::IMAGE_FOLDER, $imageName, 'public');

		// return $imageName;

        Category::create([
            'title' => $request->title,
            'slug' => $slug,
            'image' => $imageName,
            'description' => $request->description,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        // Now by type-hinting Category.
        return view('dashboard.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:categories,title,' . $category->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string',
        ]);

        $slug = Str::slug($request->title);
        if (Category::where('slug', $slug)->where('id', '!=', $category->id)->exists()) {
            return back()->withErrors(['title' => 'The title is too similar to an existing category. Please try a different name.'])->withInput();
        }

        if ($request->hasFile('image')) {
            // Delete old image
            if ($category->image) {
                Storage::disk('public')->delete(Category::IMAGE_FOLDER . '/' . $category->image);
            }

            // Store new image with unique name
            $imageName = uniqid() . '.' . $request->file('image')->extension();
            $request->file('image')->storeAs(Category::IMAGE_FOLDER, $imageName, 'public');
            $category->image = $imageName;
        }

        $category->update([
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        foreach ($category->products as $product) {
            $product->update(['category_id' => null]);
        }

        // Delete image
        if ($category->image) {
            Storage::disk('public')->delete(Category::IMAGE_FOLDER . '/' . $category->image);
        }

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
