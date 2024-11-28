<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\JobService;
use Illuminate\Http\Request;

class UserJobController extends Controller
{
    protected $jobService;

    public function __construct(JobService $jobService)
    {
        $this->jobService = $jobService;
    }


    public function index()
    {
        $user = auth()->user();
        $jobs = $this->jobService->getUserJobs($user->id);

        return view('admin.users.user-job', compact('jobs'));
    }

    public function singleUserJob(User $user)
    {
        $jobs = $this->jobService->getUserJobs($user->id);

        return view('admin.users.user-job', compact('jobs'));
    }
}
