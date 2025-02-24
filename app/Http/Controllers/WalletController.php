<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException; // added
use App\Http\Middleware\AdminMiddleware;

class WalletController extends Controller
{
	public function __construct()
    {
        $this->middleware(AdminMiddleware::class)->except('recharge');
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
		try {
			// Check for pending transactions
			$pendingTransaction = Transaction::where('user_id', Auth::id())
				->where('status', 'pending')
				->first();

			if ($pendingTransaction) {
				return back()
					->withErrors(['pending' => 'You already have a pending recharge request. Please wait for it to be processed.'], 'recharge')
					->withInput()
					->with('openRechargeModal', true);
			}

			$data = $request->validate([
				'payment_method_id' => 'required|exists:payment_methods,id',
				'amount' => 'required|numeric|min:1',
				'screenshot' => 'required|image|max:2048',
				'wallet_id' => 'nullable|exists:wallets,id', // changed: allow nullable wallet_id
			]);

			// Check if wallet exists; if not, create one.
			$wallet = isset($data['wallet_id']) ? Wallet::find($data['wallet_id']) : null;
			if (!$wallet) {
				$wallet = Wallet::create([
					'user_id' => Auth::id(),
					'balance' => 0,
				]);
			}
			$data['wallet_id'] = $wallet->id;

			// Handle file upload
			if ($request->hasFile('screenshot')) {
				$path = $request->file('screenshot')->store('screenshots', 'public');
				$data['screenshot'] = basename($path);
			}

			$data['user_id'] = Auth::id();
			$data['status'] = 'pending'; // Add default status

			Transaction::create($data);

			return back()->with('success', 'Recharge request submitted successfully.');
		} catch (ValidationException $e) {
			return back()
				->withErrors($e->errors(), 'recharge')
				->withInput()
				->with('openRechargeModal', true);
		} catch (\Exception $e) {
			return back()
				->withErrors(['unexpected' => 'An unexpected error occurred'], 'recharge')
				->withInput()
				->with('openRechargeModal', true);
		}
	}
}
