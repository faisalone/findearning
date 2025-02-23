<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Wallet; // Added for wallet balance update
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Middleware\AdminMiddleware;

class TransactionController extends Controller
{
	public function __construct()
    {
        $this->middleware(AdminMiddleware::class)->only(['approve', 'reject']);
    }
    // public function store(Request $request)
    // {
    //     $data = $request->validate([
    //         'payment_method_id' => 'required|exists:payment_methods,id',
    //         'amount' => 'required|numeric|min:1',
    //         'screenshot' => 'nullable|image|max:2048',
    //     ]);

    //     // Handle file upload if exists
    //     if ($request->hasFile('screenshot')) {
    //         $data['screenshot'] = $request->file('screenshot')->store('screenshots', 'public');
    //     }

    //     $data['user_id'] = Auth::id();

    //     Transaction::create($data);

    //     return back()->with('success', 'Transaction registered successfully.');
    // }

    public function approve($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->status = 'approved';
        $transaction->save();

        // Update wallet balance if associated wallet exists
        if ($transaction->wallet) { // Assuming a 'wallet' relationship exists
            $transaction->wallet->balance += $transaction->amount;
            $transaction->wallet->save();
        }

        return redirect()->back()->with('success', 'Transaction approved and wallet updated.');
    }

    public function reject($id)
    {
        // Find transaction and update status to 'rejected'
        $transaction = Transaction::findOrFail($id);
        $transaction->status = 'rejected';
        $transaction->save();

        return redirect()->back()->with('success', 'Transaction rejected.');
    }
}
