<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::where('role', 0)->get();
        return view('dashboard.customers.index', compact('customers'));
    }

	public function profile()
	{
		$customer = auth()->user();
		$paymentMethods = PaymentMethod::all(); // Assuming a relationship 'paymentMethods' is defined in the User model
		$transactions = $customer->wallet->transactions()->latest()->paginate(10); // Add this line
		return view('dashboard.customers.profile', compact('customer', 'paymentMethods', 'transactions'));
	}

	public function updateProfile(Request $request)
	{
		$data = $request->validate([
			'name'  => 'required|string|max:255',
			'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
			'contact' => 'nullable|string|max:20',
		]);

		auth()->user()->update($data);

		return back()->with('success', 'Profile updated successfully.');
	}

	public function orders()
	{
		$orders = auth()->user()->orders()->latest()->paginate(10);
		return view('dashboard.customers.orders', compact('orders'));
	}
}
