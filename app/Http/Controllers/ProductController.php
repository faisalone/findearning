<?php

namespace App\Http\Controllers;

use App\Models\ProductAttribute;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Variant; // added import for Variant model
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Http\Middleware\AdminMiddleware;


class ProductController extends Controller
{
	public function __construct()
    {
        $this->middleware(AdminMiddleware::class);
    }

	public function index()
	{
		$products = Product::select('id', 'category_id', 'title', 'slug', 'quantity', 'status', 'updated_at')
			->with([
				'category:id,title,slug',
				'images:id,product_id,image',
			])
			->orderBy('updated_at', 'desc')
			->paginate(15);

		// return response()->json($products);

		return view('dashboard.products.index', compact('products'));
	}

	public function create(Request $request)
	{
		$categories = Category::all();
		return view('dashboard.products.create', compact('categories'));
	}

	public function store(Request $request)
	{
		$request->validate([
			'category_id' => 'nullable|exists:categories,id',
			'title' => 'required|unique:products,title',
			'description' => 'required',
			'price'        => 'required|numeric',
        	'quantity'     => 'nullable|integer',
			'images' => 'required',
			'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
		], [
			'images.required' => 'The product images are required.',
			'images.*.image' => 'Each file must be an image.',
			'images.*.mimes' => 'Each image must be a file of type: jpeg, png, jpg, gif, svg.',
			'images.*.max' => 'Each image must not be greater than 4 MB.',
		]);

		$slug = Str::slug($request->title, '-');

		$product = Product::create([
			'category_id' => $request->category_id,
			'title' => $request->title,
			'slug' => $slug,
			'description' => $request->description,
			'price'       => $request->price,
        	'quantity'    => $request->quantity,
			'status' => 1, // Default status to published
		]);

		if ($request->hasFile('images')) {
			foreach ($request->file('images') as $image) {
				$imageName = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
				$imagePath = $image->storeAs(Product::IMAGES_FOLDER . '/' . $product->id, $imageName, 'public');

				// Ensure the correct permissions are set
				Storage::disk('public')->setVisibility($imagePath, 'public');

				ProductImage::create([
					'product_id' => $product->id,
					'image' => $imageName,
					'alt_text' => $product->title,
				]);
			}
		}

		return redirect()->route('products.index')->with('success', 'Product created successfully');
	}

	public function edit(Product $product)
	{
		// Now using route model binding.
		$categories = Category::all();
		return view('dashboard.products.edit', compact('product', 'categories'));
	}

	public function update(Request $request, Product $product)
	{
		// Inline validation or delegate to a Form Request:
		$request->validate([
			'category_id' => 'nullable|exists:categories,id',
			'title'       => 'required|unique:products,title,' . $product->id,
			'description' => 'required',
			'price'       => 'required|numeric',
			'quantity'    => 'nullable|integer',
			'images.*'    => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
		]);

		$product->update([
			'category_id' => $request->category_id,
			'title'       => $request->title,
			'slug'        => Str::slug($request->title, '-'),
			'description' => $request->description,
			'price'       => $request->price,
			'quantity'    => $request->quantity,
		]);

		// Remove images if marked.
		if ($request->has('removed_images')) {
			$removedImages = json_decode($request->removed_images, true);
			foreach ($removedImages as $imageId) {
				$image = ProductImage::findOrFail($imageId);
				Storage::disk('public')->delete(Product::IMAGES_FOLDER . '/' . $product->id . '/' . $image->image);
				$image->delete();
			}
		}

		// Add new images if uploaded.
		if ($request->hasFile('images')) {
			foreach ($request->file('images') as $image) {
				$imageName = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
				$imagePath = $image->storeAs(Product::IMAGES_FOLDER . '/' . $product->id, $imageName, 'public');
				Storage::disk('public')->setVisibility($imagePath, 'public');
				ProductImage::create([
					'product_id' => $product->id,
					'image'      => $imageName,
					'alt_text'   => $product->title,
				]);
			}
		}

		return redirect()->route('products.index')->with('success', 'Product updated successfully');
	}

	public function destroy(Product $product)
	{
		foreach ($product->productImages ?? [] as $image) {
			Storage::disk('public')->delete(Product::IMAGES_FOLDER . '/' . $product->id . '/' . $image->image);
		}
		$product->delete();
		return redirect()->route('products.index')->with('success', 'Product deleted successfully');
	}

	public function updateStatus(Request $request, $id)
	{
		$product = Product::findOrFail($id);
		$product->update(['status' => $request->status]);

		return response()->json(['success' => true, 'message' => 'Product status updated successfully']);
	}

	public function addVariant(Product $product)
	{
		$attributes = Attribute::with('values')->select('id', 'title')->get();
		return view('dashboard.products.add-variant', compact('product', 'attributes'));
	}

	public function storeVariant(Request $request, Product $product)
	{
		$validated = $request->validate([
			'variants' => 'required|array|min:1',
			'variants.*.price_factor' => 'nullable|numeric',
			'variants.*.quantity_factor' => 'nullable|numeric',
			'variants.*.attributes' => 'required|array',
			'variants.*.attributes.*' => 'nullable|integer|exists:attribute_values,id',
		]);

		// Ensure at least one attribute is provided for each variant
		foreach ($validated['variants'] as $variant) {
			if (empty(array_filter($variant['attributes']))) {
				return redirect()->back()->withErrors('Each variant must have at least one attribute.');
			}
		}


	    try {
	        DB::transaction(function () use ($validated, $product) {
	            foreach ($validated['variants'] as $variantData) {
	                $variant = $product->variants()->create([
	                    'price_factor' => $variantData['price_factor'],
	                    'quantity_factor' => $variantData['quantity_factor'],
						'sku' => $this->generateSku($product, $variantData['attributes']),
	                ]);
	                foreach ($variantData['attributes'] as $attributeId => $attributeValueId) {
	                    // Only create attribute record if a valid value is provided
	                    if ($attributeValueId !== null && $attributeValueId !== '') {
	                        $variant->attributes()->create([
	                            'attribute_id' => $attributeId,
	                            'attribute_value_id' => $attributeValueId,
	                        ]);
	                    }
	                }
	            }
	        });
	    } catch (QueryException $e) {
	        if (strpos($e->getMessage(), 'UNIQUE constraint failed') !== false) {
	            return redirect()->back()->withErrors('A variant with these attributes already exists. Please adjust the variant attributes to ensure uniqueness.');
	        }
	        throw $e;
	    }

	    return redirect()->route('products.index')->with('success', 'Variants created successfully');
	}

	private function generateSku($product, $attributes)
	{
		$productId = 'P' . $product->id;
		// Sort attributes by key to ensure consistent order
		ksort($attributes);
		$attrComponents = [];
		foreach ($attributes as $attrId => $attrValueId) {
			// Concatenation pattern: attributeId followed by 'A' plus attributeValueId
			$attrComponents[] = $attrId . 'A' . $attrValueId;
		}
		$attributesPart = implode('-', $attrComponents);
		return "{$productId}-{$attributesPart}";
	}

	// public function updateVariant(Request $request, $variantId)
	// {
	//     $validated = $request->validate([
	//         'price_factor' => 'nullable|numeric',
	//         'quantity_factor' => 'nullable|numeric',
	//     ]);
	
	//     $variant = Variant::findOrFail($variantId);
	//     $variant->update($validated);
	//     return redirect()->back()->with('success', 'Variant updated successfully');
	// }
	
	// public function destroyVariant($variantId)
	// {
	//     $variant = Variant::findOrFail($variantId);
	//     $variant->delete();
	//     return redirect()->back()->with('success', 'Variant deleted successfully');
	// }

	public function show(Product $product)
	{
		// Either return a view...
		// return view('dashboard.products.show', compact('product'));
		// ...or a resource response:
		// return new ProductResource($product);
		// Here we continue to use the view.
		return view('dashboard.products.show', compact('product'));
	}
}
