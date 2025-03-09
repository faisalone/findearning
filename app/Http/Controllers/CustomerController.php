<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Middleware\AdminMiddleware;

class CustomerController extends Controller
{
	public function __construct()
    {
        $this->middleware(AdminMiddleware::class)->only(['index', 'toggle']);
    }

    public function index()
    {
		$customers = User::where('role', '!=', 1)
            ->orderBy('created_at', 'desc') // added order by newest first
            ->get();
		// return response()->json($customers);
        return view('dashboard.customers.index', compact('customers'));
    }

	public function profile()
	{
		$customer = auth()->user();
		$paymentMethods = PaymentMethod::all(); // Assuming a relationship 'paymentMethods' is defined in the User model
		// $transactions = $customer->wallet 
        //     ? $customer->wallet->transactions()->latest()->paginate(10)
        //     : collect(); // Add this line
		$customer->transactions = $customer->transactions()->paginate(10);
		
		return view('dashboard.customers.profile', compact('customer', 'paymentMethods',));
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

    /**
     * Toggle customer status between active (role 0) and inactive (role 2).
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggle($id)
    {
        $customer = User::findOrFail($id);
        
        // Toggle role between 0 (active) and 2 (inactive)
        if ($customer->role == 0) {
            $customer->role = 2; // Set to inactive
            $message = 'Customer has been deactivated successfully.';
        } else {
            $customer->role = 0; // Set to active
            $message = 'Customer has been activated successfully.';
        }
        
        $customer->save();
        
        return redirect()->back()->with('success', $message);
    }
}
