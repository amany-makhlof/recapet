<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Services\LoginService;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $user = LoginService::authenticate($request->validated());

        if ($user) {
            Auth::login($user);
            return redirect()->intended('/wallet/transactions');
        }

        return back()->withErrors(['email' => 'The provided credentials are incorrect.']);
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();

        return redirect('/login')->with('status', 'Logged out successfully.');
    }
}
