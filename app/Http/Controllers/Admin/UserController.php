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

    // Inject UserService into the controller
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the users.
     */
    public function index()
    {
        // Use UserService to fetch users (using pagination)
        $users = $this->userService->getUsers();
        return view('admin.users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created user in the database.
     */
    public function store(Request $request)
    {
        // Validate the user and employer data
        $validatedAttributes = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'min:6', 'confirmed'],
        ]);

        $employerAttributes = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => ['required', File::types(['png', 'jpg', 'jpeg', 'webp'])],
        ]);

        // Call the UserService to create the user
        $this->userService->createUser($validatedAttributes, $employerAttributes, $request);

        // Redirect back with a success message
        return redirect()->route('admin.users')
            ->with('success', 'User created successfully.');
    }

    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        return view('admin.users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', ['user' => $user]);
    }

    /**
     * Update the specified user in the database.
     */
    public function update(Request $request, User $user)
    {
        // Validate the user data (name, email, password)
        $validatedAttributes = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'], // Only validate if the password is provided
        ]);

        // Validate employer-specific data (like employer name and logo)
        $employerAttributes = $request->validate([
            'employer' => ['required', 'string', 'max:255'],
            'logo' => ['nullable', 'file', 'mimes:png,jpg,jpeg,webp'], // Allow logo to be optional, but validate if it exists
        ]);

        // Call the UserService to update the user and employer data
        $this->userService->updateUser($user, $validatedAttributes, $employerAttributes, $request);

        // Redirect back with a success message
        return redirect()->route('admin.users')
            ->with('success', 'User has been updated successfully.');
    }

    /**
     * Activate the specified user.
     */
    public function activate(User $user): RedirectResponse
    {
        // Use the UserService to activate the user
        $this->userService->activateUser($user);

        // Redirect with success message
        return redirect()->route('admin.users')
            ->with('success', 'User activated successfully!');
    }

    /**
     * Deactivate the specified user.
     */
    public function deactivate(User $user)
    {
        // Use the UserService to deactivate the user
        $this->userService->deactivateUser($user);

        // Redirect with success message
        return redirect()->route('admin.users')
            ->with('success', 'User deactivated successfully!');
    }

    /**
     * Delete the specified user from storage.
     */
    public function destroy(User $user)
    {
        // Call the UserService to delete the user
        $this->userService->deleteUser($user);

        // Flash success message and redirect
        session()->flash('success', 'User has been deleted successfully.');
        return redirect()->route('admin.users');
    }
}
