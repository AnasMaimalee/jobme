<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;

class RegisteredUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedAttributes = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'min:6', 'confirmed'],
        ]);

        $employerAttributes = $request->validate([
            'employer' => 'nullable',
            'logo' => ['nullable', 'file', 'mimes:png,jpg,jpeg,webp'],
        ]);

        $user = User::create($validatedAttributes);

        // Only create employer if employer info is provided
        if ($employerAttributes['employer']) {
            $logoPath = $request->logo ? $request->logo->store('logos') : null;
            $user->employer()->create([
                'name' => $employerAttributes['employer'],
                'logo' => $logoPath,
            ]);
        }

        Auth::login($user);

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
    public function destroy(string $id)
    {
        //
    }
}
