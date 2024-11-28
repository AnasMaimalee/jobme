<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\User;
use App\Services\JobService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class JobsController extends Controller
{
    protected $jobService;

    public function __construct(JobService $jobService)
    {
        $this->jobService = $jobService;
    }

    // Display all jobs
    public function index()
    {
        $jobs = $this->jobService->getAllJobs();
        return view('admin.jobs.index', compact('jobs'));
    }

    // Display jobs for a specific user (employer)
    public function indexByUser(User $user)
    {
        $jobs = $this->jobService->getJobsByUser($user->id);
        return view('admin.jobs.index', compact('jobs', 'user'));
    }

    // Show a specific job
    public function show(Job $job)
    {
        // You can pass the job object to the view
        return view('admin.jobs.show', compact('job'));
    }

    // Create a new job
    public function create()
    {
        return view('admin.jobs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'employer_id' => 'required|exists:users,id', // Ensure employer exists
        ]);

        $job = $this->jobService->createJob($validated);

        return redirect()->route('admin.jobs')->with('success', 'Job created successfully!');
    }

    // Edit a job
    public function edit(Job $job)
    {
        return view('admin.jobs.edit', compact('job'));
    }

    /**
     * @param Request $request
     * @param Job $job
     * @return RedirectResponse
     */
    public function update(Request $request, Job $job): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $this->jobService->updateJob($job, $validated);

        return redirect()->route('admin.job')->with('success', 'Job updated successfully!');
    }

    /**
     * @param Job $job
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Job $job): RedirectResponse
    {
        $this->jobService->deleteJob($job);
        return redirect()->route('admin.jobs')->with('success', 'Job deleted successfully!');
    }
}
