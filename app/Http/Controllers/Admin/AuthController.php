<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

   public function login(Request $request)
   {
       $credentials = $request->validate([
           'username' => ['required'],
           'password' => ['required'],
       ]);
   
       if (Auth::guard('admin')->attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
           $request->session()->regenerate();
           return redirect()->intended(route('admin.dashboard'));
       }
   
       return back()->withErrors([
           'username' => 'The provided credentials do not match our records.',
       ]);
   }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
