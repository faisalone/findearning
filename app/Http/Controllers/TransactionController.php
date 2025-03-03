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
        $this->middleware(AdminMiddleware::class)->only(['approve', 'reject', 'adjust']);
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
        // Find transaction
        $transaction = Transaction::findOrFail($id);
        
        // Check if transaction was previously approved - need to adjust wallet
        $wasApproved = $transaction->status === 'approved';
        
        // Update status to 'rejected'
        $transaction->status = 'rejected';
        $transaction->save();
        
        // If it was previously approved, subtract the amount from wallet
        if ($wasApproved && $transaction->wallet) {
            $transaction->wallet->balance -= $transaction->amount;
            $transaction->wallet->save();
            
            return redirect()->back()->with('success', 'Transaction rejected and wallet balance adjusted.');
        }
        
        return redirect()->back()->with('success', 'Transaction rejected.');
    }

    /**
     * Adjust the transaction amount
     */
    public function adjust(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);

        // Find the transaction
        $transaction = Transaction::findOrFail($id);
        $newAmount = $request->amount;
        
        // Update the transaction amount
        $transaction->amount = $newAmount;
        $transaction->save();
        
        
        return redirect()->back()->with('success', 'Transaction amount adjusted successfully.');
    }
}
