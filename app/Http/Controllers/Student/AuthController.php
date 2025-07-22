<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Show login form
     */
    public function showLoginForm()
    {
        return view('student.auth.login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'nip' => 'required',
            'password' => 'required',
        ]);

        if (Auth::guard('web')->attempt(['nip' => $credentials['nip'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            return redirect()->intended(route('student.dashboard'));
        }

        return back()->withErrors([
            'nip' => 'The provided credentials do not match our records.',
        ])->onlyInput('nip');
    }

    /**
     * Handle logout request
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
