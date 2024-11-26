<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use App\Models\Job;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs  = Job::latest()->get()->groupBy('featured');
        return view('jobs.index', [
            'jobs' => $jobs[0],
            'featuredJobs' => $jobs[1],
            'tags' => Tag::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => 'required',
            'salary' => 'required',
            'location' => 'required',
            'schedule' => ['required', Rule::in(['Part Time', 'Full Time'])],
            'url' => ['required', 'active_url'],
            'tags' => 'nullable'
        ]);

        $attributes['featured'] = $request->has('featured');
        $job = Auth::user()->employer->jobs()->create(Arr::except($attributes, 'tags'));

        if($attributes['tags'] ?? false) {
            foreach (explode(',', $attributes['tags']) as $tag) {
                $job->tag($tag);
            }
        }

        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        return view('jobs.show', ['job' => $job]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        return view('jobs.edit', [
            'job' => $job
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
        $attributes = $request->validate([
            'title' => 'required',
            'salary' => 'required',
            'location' => 'required',
            'schedule' => ['required', Rule::in(['Part Time', 'Full Time'])],
            'url' => ['required', 'active_url'],
            'tags' => 'nullable',
            'featured' => 'nullable|boolean',
        ]);

        // Update the job fields
        $job->update([
            'title' => $attributes['title'],
            'salary' => $attributes['salary'],
            'location' => $attributes['location'],
            'schedule' => $attributes['schedule'],
            'url' => $attributes['url'],
            'featured' => $request->has('featured'), // Handle the featured checkbox
        ]);

        // Handle updating tags
        if ($attributes['tags'] ?? false) {
            // Remove existing tags and add the new ones
            $job->tags()->detach(); // Detach current tags

            foreach (explode(',', $attributes['tags']) as $tag) {
                $job->tag($tag); // Add new tags
            }
        }

        return redirect()->route('jobs.show', $job);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        //
    }
}
