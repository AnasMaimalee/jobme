<?php
namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class UserService
{
    protected $userRepository;

// Inject UserRepository into the service
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

// Get users (pagination handled here)
    public function getUsers()
    {
        return $this->userRepository->getAllUsers();
    }

// Create a new user
    public function createUser(array $validatedAttributes, array $employerAttributes, Request $request)
    {
        $validatedAttributes['password'] = Hash::make($validatedAttributes['password']);

        $user = $this->userRepository->create($validatedAttributes);

        $this->userRepository->createEmployer($user, $employerAttributes);

        return $user;
    }

// Update an existing user
    public function updateUser(User $user, array $validatedAttributes, array $employerAttributes, Request $request)
    {
// If password is provided, hash it before updating
        if (!empty($validatedAttributes['password'])) {
            $validatedAttributes['password'] = Hash::make($validatedAttributes['password']);
        }

// Handle logo file upload if present
        if ($request->hasFile('logo')) {
            $validatedAttributes['logo'] = $request->file('logo')->store('logos');
        }

// Update the user using the repository
        $this->userRepository->update($user, $validatedAttributes);

// Update employer information
        $this->userRepository->updateEmployer($user, $employerAttributes);
    }

// Activate a user
    public function activateUser(User $user)
    {
        if ($user->status !== 'active') {
            $user->update(['status' => 'active']);
        }
    }

// Deactivate a user
    public function deactivateUser(User $user)
    {
        if ($user->status !== 'inactive') {
            $user->update(['status' => 'inactive']);
        }
    }

// Delete a user
    public function deleteUser(User $user)
    {
        $this->userRepository->delete($user);

// Optionally delete related employer data if necessary
        $user->employer()->delete();
    }
}
