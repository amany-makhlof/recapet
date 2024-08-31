<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Services\RegisterService;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class RegisterController extends Controller
{
    public function showRegistrationForm(): View
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request): RedirectResponse
    {
        try {
            $user = RegisterService::register($request->validated());
            Auth::login($user);

            return redirect('/wallet/transactions')->with('status', 'Registration successful!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }
}
