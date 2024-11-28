<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    // Get all users (pagination or any other method)
    public function getAllUsers()
    {
        return User::paginate(10);
    }

    // Create a new user
    public function create(array $attributes)
    {
        return User::create($attributes);
    }

    // Update an existing user
    public function update(User $user, array $attributes)
    {
        return $user->update($attributes);
    }

    // Delete a user
    public function delete(User $user)
    {
        return $user->delete();
    }

    public function createEmployer(User $user, array $employerAttributes)
    {
        return $user->employer()->create($employerAttributes);
    }

    // Update employer details for a user
    public function updateEmployer(User $user, array $employerAttributes)
    {
        // Assuming Employer is a related model
        return $user->employer()->update($employerAttributes);
    }
}
