<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function index()
    {
        $data = [
            'title' => 'Login Admin',
            'active' => null,
            'is_auth' => true,
        ];
        return view('pages.auth.login', $data);
    }

    public function auth(Request $request)
    {
        $validatedData = $request->validate([
            'email' => ['required'],
            'password' => ['required', 'min:6'],
        ]);
        if (Auth::attempt($validatedData)) {
            $user = Auth::user();
            if ($user->role == User::ADMIN) {
                $request->session()->regenerate();
                return redirect()->intended('dashboard');
            }else{
                return back()->withErrors([
                    'email' => 'The provided credentials do not match our records.',
                ])->onlyInput('email');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

}
