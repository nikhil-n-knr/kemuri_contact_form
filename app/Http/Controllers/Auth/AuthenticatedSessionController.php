<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Helpers\ContactLogger;

class AuthenticatedSessionController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);
    
        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            $this->logLogin('failed', $request);
            throw ValidationException::withMessages([
                'email' => 'Invalid email or password.',
            ]);
        }
    
        if (!auth()->user()->is_admin) {
            Auth::logout();
            $this->logLogin('denied', $request);
            throw ValidationException::withMessages([
                'email' => 'Access denied.',
            ]);
        }
    
        $request->session()->regenerate();
        $this->logLogin('success', $request);
    
        return redirect()->intended(RouteServiceProvider::HOME);
    }
    
    private function logLogin(string $status, Request $request): void
        {
            ContactLogger::log([
                'status'   => $status,
                'email'    => $request->input('email'),
                'user_id'  => optional(auth()->user())->id,
                'ip'       => $request->ip(),
                'agent'    => $request->userAgent(),
                'time'     => now()->toDateTimeString(),
            ], 'LOGIN');
        }

}
