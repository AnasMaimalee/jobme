<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;

class UserController extends Controller
{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.index', ['users' => $users]);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        // Validate user and employer data
        $validatedAttributes = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'min:6', 'confirmed'],
        ]);

        $employerAttributes = $request->validate([
            'employer' => 'required|string|max:255',
            'logo' => ['required', File::types(['png', 'jpg', 'jpeg', 'webp'])],
        ]);

        // Use the UserService to create the user
        $this->userService->createUser($validatedAttributes, $employerAttributes, $request);

        return redirect()->route('admin.users')
            ->with('success', 'User created successfully.');
    }
    public function show(User $user)
    {
       return view('admin.users.show', ['user' => $user]);
    }
    public function edit(User $user)
    {
        return view('admin.users.edit', ['user' => $user]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Validate user data (name, email, password)
        $validatedAttributes = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'string', 'min:4', 'confirmed'], // Only validate if the password is provided
        ]);

        // Validate employer-specific data (like employer name and logo)
        $employerAttributes = $request->validate([
            'employer' => ['required', 'string', 'max:255'],
            'logo' => ['nullable', 'file', 'mimes:png,jpg,jpeg,webp'], // Allow logo to be optional, but validate if it exists
        ]);

        // Call the UserService to update the user and employer data
        $this->userService->updateUser($user, $validatedAttributes, $employerAttributes, $request);

        // Redirect back with success message
        return redirect()->route('admin.users')
            ->with('success', 'User has been updated successfully.');
    }



    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activate(User $user): RedirectResponse
    {

        // Check if the user is not already active
        if ($user->status !== 'active') {
            $user->update(['status' => 'active']);
        }

        return redirect()->route('admin.users')->with('success', 'User activated successfully!');
    }


    public function deactivate(User $user)
    {
        // Ensure you're retrieving the user from the database
        $user = User::find($user->id);

        // If the status is already inactive, we don't need to update it
        if ($user && $user->status !== 'inactive') {
            // Update only the status field
            $user->update(['status' => 'inactive']);
        }

        return redirect()->route('admin.users')->with('success', 'User deactivated successfully!');
    }
    public function destroy(User $user)
    {
        $user->delete();
        $user->employer()->delete();
        // Flash a success message to the session
        session()->flash('success', 'User has been deleted successfully.');
        return redirect()->route('admin.users');
    }
}
