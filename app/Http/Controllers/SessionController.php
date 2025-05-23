<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class SessionController extends Controller
{
public function index(){

    if (auth()->check()) {
        return redirect('/blogs');
    }

    return view('auth.login');
}

public function store()
{
    $credentials = request()->only('email', 'password');

    if (auth()->attempt($credentials)) {
        request()->session()->regenerate();

        // Force redirect to /blogs instead of intended URL
        return redirect()->route('blogs.index');
    }

    return back()->withErrors([
        'email' => 'Invalid credentials.',
    ]);
}


    /**
     * Handle user logout
     */
    public function destroy(Request $request)
    {
        // Log the user out
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the CSRF token
        $request->session()->regenerateToken();

        // Redirect to login page with success message
        return redirect('/login')->with('success', 'You have been logged out successfully.');
    }
}
