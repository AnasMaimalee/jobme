<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;

class JobsController extends Controller
{
    public function index()
    {
        $jobs = Job::paginate(10);
        return view('admin.jobs.index', ['jobs' => $jobs]);
    }

    public function show(Job $job)
    {
        return view('admin.jobs.show', ['job' => $job]);
    }

    public function destroy(Job $job)
    {
        $job->delete();
        session()->flash('error', 'Job has been deleted successfully.');
        return redirect()->route('admin.jobs');
    }
}
