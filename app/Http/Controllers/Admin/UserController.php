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

    }
    public function show($id)
    {

    }
    public function edit(User $user)
    {
        return view('admin.users.edit', ['user' => $user]);
    }
    public function update(Request $request, User $user)
    {

    }

    public function destroy(User $user)
    {

    }
}
