<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'id_number' => 'required|string',
        ]);

        $user = User::where('email', $request->email)
                    ->where('id_number', $request->id_number)
                    ->first();

        if ($user) {
            Auth::login($user);
            return redirect()->intended('admin');
        }

        return redirect()->back()->with('error', 'Invalid email or ID number.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
