<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function search(Request $request)
    {
        $nip = $request->input('nip');
        
        $user = User::where('nip', $nip)->first();
        
        if (!$user) {
            return redirect()->back()->with('error', 'User with NIP ' . $nip . ' not found.');
        }

        $paymentProofs = $user->paymentProofs()->orderBy('period', 'desc')->get();
        
        if ($paymentProofs->isEmpty()) {
            return redirect()->back()->with('error', 'No payment proofs found for this user.');
        }

        return view('files.search-results', [
            'user' => $user,
            'paymentProofs' => $paymentProofs
        ]);
    }
}
