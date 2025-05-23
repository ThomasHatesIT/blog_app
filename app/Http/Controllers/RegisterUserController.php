<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterUserController extends Controller
{
    public function index(){

       if (auth()->check()) {
        return redirect('/blogs');
    }

    return view('auth.register');
    }

      public function store()
    {
        $attributes = request()->validate([
          
            'username'  => ['required'],
            'email'      => ['required', 'email', 'unique:users,email'],
            'password'   => ['required', Password::default(), 'confirmed'],
        ]);

    $attributes['password'] = Hash::make($attributes['password']);

        $user = User::create($attributes);

        Auth::login($user);

        return redirect('/blogs')->with('message', 'User registered!');;
    }
}
