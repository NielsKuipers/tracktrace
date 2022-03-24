<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);

        if(auth()->attempt($attributes))
        {
            session()->regenerate();
            return redirect('home')->with('success', 'Successfully logged in!');
        }

        throw ValidationException::withMessages(['email' => 'Email or password is incorrect.']);
    }

    public function destroy(): RedirectResponse
    {
        auth()->logout();

        return redirect(route('home'))->with('success', 'Successfully logged out!');
    }
}
