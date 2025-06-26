<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PaymentProof;
use Illuminate\Http\Request;

class PaymentProofSearchController extends Controller
{
    public function search(Request $request)
    {
        $request->validate([
            'nip' => 'required|numeric'
        ]);

        $user = User::where('nip', $request->nip)->first();

        if (!$user) {
            return back()->with('error', 'No student found with the provided NIP.');
        }

        $paymentProofs = PaymentProof::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        if ($paymentProofs->isEmpty()) {
            return back()->with('error', 'No payment proof files found for this NIP.');
        }

        return view('payment-proofs.search-results', [
            'user' => $user,
            'paymentProofs' => $paymentProofs
        ]);
    }
}