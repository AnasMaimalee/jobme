<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $totalUsers = User::all()->count();
        $totalEmployers = Employer::all()->count();
        $totalJobPosted = Job::all()->count();

        $users = User::all();
        return view('admin.index', [
            'users' => $users,
            'user' => $user,
            'totalUsers' => $totalUsers,
            'totalEmployers' => $totalEmployers,
            'totalJobPosted' => $totalJobPosted
        ]);
    }



}
