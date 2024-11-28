<?php

namespace App\Services;

use App\Models\User;
use App\Models\Employer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserService
{
    /**
     * Create a new user and associated employer.
     *
     * @param array $validatedUserData
     * @param array $validatedEmployerData
     * @param \Illuminate\Http\Request $request
     * @return \App\Models\User
     */
    public function createUser(array $validatedUserData, array $validatedEmployerData, $request)
    {
        // Create the user
        $user = User::create([
            'name' => $validatedUserData['name'],
            'email' => $validatedUserData['email'],
            'password' => Hash::make($validatedUserData['password']),
            'status' => 'inactive', // Default status for new users
        ]);

        // Store the employer logo and create the employer record
        $logoPath = $request->file('logo')->store('logos', 'public'); // Store logo in 'public/logos'

        // Create associated employer
        $user->employer()->create([
            'name' => $validatedEmployerData['employer'],
            'logo' => $logoPath,
        ]);

        return $user;
    }

    /**
     * Update user details.
     *
     * @param \App\Models\User $user
     * @param array $validatedUserData
     * @param array $validatedEmployerData
     * @param \Illuminate\Http\Request $request
     * @return \App\Models\User
     */
    public function updateUser(User $user, array $validatedUserData, array $validatedEmployerData, $request)
    {
        // Update user details
        $user->update([
            'name' => $validatedUserData['name'],
            'email' => $validatedUserData['email'],
            'password' => $validatedUserData['password'] ? Hash::make($validatedUserData['password']) : $user->password,
        ]);

        // Update employer details if provided
        if ($request->has('employer')) {
            $user->employer->update([
                'name' => $validatedEmployerData['employer'],
            ]);
        }

        // Update logo if new file is provided
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $user->employer->update([
                'logo' => $logoPath,
            ]);
        }

        return $user;
    }

    /**
     * Delete a user and associated employer.
     *
     * @param \App\Models\User $user
     * @return bool|null
     */
    public function deleteUser(User $user)
    {
        // You can optionally delete the user's employer logo or handle any other clean-up
        if ($user->employer && $user->employer->logo) {
            Storage::delete($user->employer->logo); // Delete the logo from storage
        }

        // Delete the user and associated employer record
        return $user->delete();
    }
}
