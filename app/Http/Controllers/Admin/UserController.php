<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

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
        $attributes = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create($attributes);
        session()->flash('success', 'User has been created successfully.');
        return redirect()->route('admin.users');
    }
    public function show(User $user)
    {
       return view('admin.users.show', ['user' => $user]);
    }
    public function edit(User $user)
    {
        return view('admin.users.edit', ['user' => $user]);
    }
    public function update(Request $request, User $user)
    {
        $attributes = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $user->update($attributes);
        return redirect()->route('admin.users');
    }

    public function activate(User $user)
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
        // Flash a success message to the session
        session()->flash('success', 'User has been deleted successfully.');
        return redirect()->route('admin.users');
    }
}
