<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $users = User::all();
        return view('admin.index', ['users' => $users, 'user' => $user]);
    }



}
