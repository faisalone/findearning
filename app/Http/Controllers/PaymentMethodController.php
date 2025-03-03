<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Middleware\AdminMiddleware;

class PaymentMethodController extends Controller
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
        $paymentMethods = PaymentMethod::paginate(10);
        return view('dashboard.payment-methods.index', compact('paymentMethods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(PaymentMethod $paymentMethod)
    {
        return view('dashboard.payment-methods.create', compact('paymentMethod'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
		// return $request->all();
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'rate'        => 'required|numeric',
            'address'     => 'nullable|string',
            'instruction' => 'nullable|string',
            'image'       => 'nullable|mimes:jpg,jpeg,png,svg,webp',
            'qr'          => 'nullable|mimes:jpg,jpeg,png,svg,webp',
            'status'      => 'required|boolean',
        ]);

		if ($request->hasFile('image')) {
			$imageName = uniqid() . '.' . $request->file('image')->extension();
			$request->file('image')->storeAs(PaymentMethod::IMAGE_FOLDER, $imageName, 'public');
			$validated['image'] = $imageName;
		}
        
        if ($request->hasFile('qr')) {
			$qrName = uniqid() . '_qr.' . $request->file('qr')->extension();
			$request->file('qr')->storeAs(PaymentMethod::IMAGE_FOLDER, $qrName, 'public');
			$validated['qr'] = $qrName;
		}

        PaymentMethod::create($validated);

        return redirect()->route('payment-methods.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentMethod $paymentMethod)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaymentMethod $paymentMethod)
    {
        return view('dashboard.payment-methods.edit', compact('paymentMethod'));
    }

    /**
     * Update the specified resource in storage.
     */
	public function update(Request $request, PaymentMethod $paymentMethod)
	{
		$validated = $request->validate([
			'name'        => 'required|string|max:255',
			'rate'        => 'required|numeric',
			'address'     => 'nullable|string',
			'instruction' => 'nullable|string',
            'image'       => 'nullable|mimes:jpg,jpeg,png,svg,webp',
            'qr'          => 'nullable|mimes:jpg,jpeg,png,svg,webp',
			'status'      => 'required|boolean',
		]);

		if ($request->hasFile('image')) {
			if ($paymentMethod->image) {
				Storage::disk('public')->delete(PaymentMethod::IMAGE_FOLDER . '/' . $paymentMethod->image);
			}
			$imageName = uniqid() . '.' . $request->file('image')->extension();
			$request->file('image')->storeAs(PaymentMethod::IMAGE_FOLDER, $imageName, 'public');
			$validated['image'] = $imageName;
		}
        
        if ($request->hasFile('qr')) {
			if ($paymentMethod->qr) {
				Storage::disk('public')->delete(PaymentMethod::IMAGE_FOLDER . '/' . $paymentMethod->qr);
			}
			$qrName = uniqid() . '_qr.' . $request->file('qr')->extension();
			$request->file('qr')->storeAs(PaymentMethod::IMAGE_FOLDER, $qrName, 'public');
			$validated['qr'] = $qrName;
		}

		$paymentMethod->update($validated);

		return redirect()->route('payment-methods.index');
	}

    /**
     * Remove the specified resource from storage.
     */
	public function destroy(PaymentMethod $paymentMethod)
	{
		if ($paymentMethod->image) {
			Storage::disk('public')->delete(PaymentMethod::IMAGE_FOLDER . '/' . $paymentMethod->image);
		}
        
        if ($paymentMethod->qr) {
			Storage::disk('public')->delete(PaymentMethod::IMAGE_FOLDER . '/' . $paymentMethod->qr);
		}

		$paymentMethod->delete();

		return redirect()->route('payment-methods.index')
						 ->with('success', 'Payment method deleted successfully.');
	}
}
