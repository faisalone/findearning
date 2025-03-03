<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException; // added
use App\Http\Middleware\AdminMiddleware;
use App\Models\PaymentMethod;

class WalletController extends Controller
{
	public function __construct()
    {
        $this->middleware(AdminMiddleware::class)->except(['rechargeIndex', 'recharge']);
    }

	public function rechargeIndex()
	{
		// Modified to exclude payment method named "Wallet"
		$paymentMethods = PaymentMethod::where('status', true)
			->where('name', '!=', 'Wallet')  // Exclude the "Wallet" payment method
			->get();
		
		return view('dashboard.customers.recharge', compact('paymentMethods'));
	}

    public function index()
	{
		$wallets = Wallet::all();
		// Eager load paymentMethod relation along with wallet.user.
		$transactions = Transaction::with('wallet.user', 'paymentMethod')
			->orderBy('created_at', 'desc')
			->paginate(10);
		
		return view('dashboard.wallet.index', compact('wallets', 'transactions'));
	}

	public function recharge(Request $request)
	{
		$request->validate([
			'wallet_id' => 'required|exists:wallets,id',
			'payment_method_id' => 'required|exists:payment_methods,id',
			'amount' => 'required|numeric|min:1',
			'screenshot' => 'required|image|max:2048',
		], [], [
			'wallet_id' => 'wallet',
			'payment_method_id' => 'payment method',
		]);

		// Check if user already has a pending transaction
		$pendingTransaction = Transaction::where('user_id', auth()->id())
			->where('status', 'pending')
			->first();

		if ($pendingTransaction) {
			return back()->with('error', 'You already have a pending transaction. Please wait for it to be processed.');
		}

		// Store screenshot and get the filename
		$path = $request->file('screenshot')->store('transactions', 'public');
		$filename = basename($path);

		// Create transaction
		$transaction = Transaction::create([
			'user_id' => auth()->id(),
			'wallet_id' => $request->wallet_id,
			'payment_method_id' => $request->payment_method_id,
			'amount' => $request->amount,
			'screenshot' => $filename,
			'status' => 'pending',
		]);

		return redirect()->route('recharge.index')->with('success', 'Recharge request submitted successfully. It will be processed shortly.');
	}
}
