<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        // Validate the email and password
        $validatedAttributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt to authenticate the user
        if (!Auth::attempt($validatedAttributes)) {
            throw ValidationException::withMessages([
                'email' => 'Sorry, Invalid Credentials.'
            ]);
        }

        // Regenerate the session to prevent session fixation attacks
        request()->session()->regenerate();

        // Get the authenticated user
        $user = Auth::user();

        // Check if the user status is 'active'
        if ($user->status !== 'active') {
            // If the user is not active, log them out and show an error message
            Auth::logout();
            throw ValidationException::withMessages([
                'email' => 'Your account is ' . $user->status . '. Please contact support or check your account status.'
            ]);
        }

        // If the user is the admin
        if ($user->email === 'anas@admin.me') {
            return redirect('/admin/dashboard');
        }

        // Redirect the user to the homepage if everything is fine
        return redirect('/');
    }




    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
