<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    /**
     * @return mixed
     */
    public function getAllUsers()
    {
        return User::paginate(10);
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return User::create($attributes);
    }

    /**
     * @param User $user
     * @param array $attributes
     * @return bool
     */
    public function update(User $user, array $attributes)
    {
        return $user->update($attributes);
    }

    /**
     * @param User $user
     * @return bool|null
     */
    public function delete(User $user)
    {
        return $user->delete();
    }

    /**
     * @param User $user
     * @param array $employerAttributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function createEmployer(User $user, array $employerAttributes)
    {
        return $user->employer()->create($employerAttributes);
    }

    /**
     * @param User $user
     * @param array $employerAttributes
     * @return int
     */
    public function updateEmployer(User $user, array $employerAttributes)
    {
        return $user->employer()->update($employerAttributes);
    }
}
