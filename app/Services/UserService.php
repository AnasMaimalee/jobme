<?php
namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return mixed
     */
    public function getUsers(): mixed
    {
        return $this->userRepository->getAllUsers();
    }
    /**
     * @param array $validatedAttributes
     * @param array $employerAttributes
     * @param Request $request
     * @return mixed
     */
    public function createUser(array $validatedAttributes, array $employerAttributes, Request $request): mixed
    {
        $validatedAttributes['password'] = Hash::make($validatedAttributes['password']);

        $user = $this->userRepository->create($validatedAttributes);

        $this->userRepository->createEmployer($user, $employerAttributes);

        return $user;
    }
    /**
     * @param User $user
     * @param array $validatedAttributes
     * @param array $employerAttributes
     * @param Request $request
     * @return void
     */
    public function updateUser(User $user, array $validatedAttributes, array $employerAttributes, Request $request): void
    {
        if (!empty($validatedAttributes['password'])) {
            $validatedAttributes['password'] = Hash::make($validatedAttributes['password']);
        }

        $this->userRepository->update($user, $validatedAttributes);

        $this->userRepository->updateEmployer($user, $employerAttributes);
    }

    /**
     * @param User $user
     * @return void
     */
    public function activateUser(User $user): void
    {
        if ($user->status !== 'active') {
            $user->update(['status' => 'active']);
        }
    }

    /**
     * @param User $user
     * @return void
     */
    public function deactivateUser(User $user): void
    {
        if ($user->status !== 'inactive') {
            $user->update(['status' => 'inactive']);
        }
    }

    /**
     * @param User $user
     * @return void
     */
    public function deleteUser(User $user): void
    {
        $this->userRepository->delete($user);

        $user->employer()->delete();
    }
}
